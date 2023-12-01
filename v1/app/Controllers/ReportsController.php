<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\ReportsModel;
use GuzzleHttp\Client as GuzzleClient;

class ReportsController extends BaseController
{
    private $reports_model;

    // Re-used functions
    private function validateReport($report)
    {
        $rules = [
            'report_status' => ['required', ['in', ['IC', 'AO']]],
            'fatalities' => ['required', 'integer'],
            'case_status' => ['required', ['in', ['Solved', 'Unsolved', 'Open']]],
            'premise' => ['required', 'ascii'],
            'weapon_id' => ['required', 'integer'],
            'crime_codes' => ['required', 'array'],
            'criminal_ids' => ['required', 'array'],
            'modus_codes' => ['required', 'array'],
            'police_ids' => ['required', 'array'],
            'victim_ids' => ['required', 'array'],
            'incident' => ['required', 'array'],
            'location' => ['required', 'array'],
        ];

        $validated = $this->validateData($report, $rules);
        if ($validated !== true) {
            return $validated;
        }

        // crime_codes, criminal_ids, victim_ids, police_ids should be arrays of integers
        if (!Input::isIntArray($report['crime_codes'], 0)) return "Invalid crime codes";
        if (!Input::isIntArray($report['criminal_ids'], 0)) return "Invalid criminal IDs";
        if (!Input::isIntArray($report['victim_ids'], 0)) return "Invalid victim IDs";
        if (!Input::isIntArray($report['police_ids'], 0)) return "Invalid police IDs";

        // modus_codes is an array of numeric strings
        if (!Input::isNumericArray($report["modus_codes"])) return "Invalid modus codes";

        // Validate that incident is an array with reported_time and occurred_time
        $incident_rules = [
            'reported_time' => ['required', 'date'],
            'occurred_time' => ['required', 'date'],
        ];

        $incident_validated = $this->validateData($report['incident'], $incident_rules);
        if ($incident_validated !== true) {
            return $incident_validated;
        }

        // Validate that location is an array with district_id, address, cross_street, area_name, latitude, longitude
        $location_rules = [
            'district_id' => ['required', 'integer'],
            'address' => ['required', 'ascii'],
            'cross_street' => ['optional', 'ascii'],
            'area_name' => ['required', 'ascii'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
        ];

        $location_validated = $this->validateData($report['location'], $location_rules);
        if ($location_validated !== true) {
            return $location_validated;
        }

        return true;
    }

    public function __construct()
    {
        $this->reports_model = new ReportsModel();
    }

    public function handleGetReports(Request $request, Response $response)
    {
        $filters = $this->getFilters($request, $this->reports_model, [
            'report_id',
            'last_update',
            'fatalities',
            'premise',
        ]);

        // Validate filters
        $rules = [
            'from_last_update' => ['optional', 'date'],
            'to_last_update' => ['optional', 'date'],
            'fatalities' => ['optional', 'integer'],
            'criminal_count' => ['optional', 'integer'],
            'victim_count' => ['optional', 'integer'],
            'crime_code' => ['optional', 'integer'],
            'modus_code' => ['optional', 'numeric'],
            'premise' => ['optional', 'ascii'],
        ];

        $validated = $this->validateData($filters, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        $reports = $this->reports_model->getAllReports($filters);
        return $this->prepareOkResponse($response, (array) $reports);
    }

    public function handleGetReportById(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Find the report
        $report = $this->reports_model->getReportById($id);
        if (!$report)
            throw new HttpNotFoundException($request, 'Report not found');

        // Send the response
        return $this->prepareOkResponse($response, (array) $report);
    }

    public function handleGetReportVictims(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Make sure the report exists
        $report = $this->reports_model->getReportById($id);
        if (!$report) {
            throw new HttpNotFoundException($request, "Report not found");
        }

        $filters = $this->getFilters($request, $this->reports_model, [
            'victim_id',
            'first_name',
            'last_name',
            'age',
            'height'
        ]);

        // Validate filters
        $rules = [
            'first_name' => ['optional', 'ascii'],
            'last_name' => ['optional', 'ascii'],
            'age' => ['optional', 'integer'],
            'descent' => ['optional', 'alpha', ['length', 1]],
            'sex' => ['optional', ['in', ['M', 'F', 'X']]]
        ];

        $validated = $this->validateData($filters, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        // Get the victims
        $victims = $this->reports_model->getReportVictims($id, $filters);

        // Send the response
        return $this->prepareOkResponse($response, (array) $victims);
    }

    public function handleGetReportCriminals(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Make sure the report exists
        $report = $this->reports_model->getReportById($id);
        if (!$report) {
            throw new HttpNotFoundException($request, "Report not found");
        }

        $filters = $this->getFilters($request, $this->reports_model, [
            'criminal_id',
            'first_name',
            'last_name',
            'age',
            'height'
        ]);

        // Validate filters
        $rules = [
            'first_name' => ['optional', 'ascii'],
            'last_name' => ['optional', 'ascii'],
            'age' => ['optional', 'integer'],
            'descent' => ['optional', 'alpha', ['length', 1]],
            'sex' => ['optional', ['in', ['M', 'F', 'X']]],
            'is_arrested' => ['optional', ['in', [0, 1]]]
        ];

        $validated = $this->validateData($filters, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        // Get the criminals
        $criminals = $this->reports_model->getReportCriminals($id, $filters);

        // Send the response
        return $this->prepareOkResponse($response, (array) $criminals);
    }

    public function handleGetReportPolice(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Make sure the report exists
        $report = $this->reports_model->getReportById($id);
        if (!$report) {
            throw new HttpNotFoundException($request, "Report not found");
        }

        $filters = $this->getFilters($request, $this->reports_model, [
            'badge_id',
            'first_name',
            'last_name',
            'join_date',
            'rank'
        ]);

        $rules = [
            'first_name' => ['optional', 'ascii'],
            'last_name' => ['optional', 'ascii'],
            'from_join_date' => ['optional', 'date'],
            'to_join_date' => ['optional', 'date'],
            'rank' => ['optional', 'alphaNum'],
        ];

        $validated = $this->validateData($filters, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        // Get the police officers
        $police = $this->reports_model->getReportPolice($id, $filters);

        // Send the response
        return $this->prepareOkResponse($response, (array) $police);
    }

    public function handleGetReportCrimes(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Make sure the report exists
        $report = $this->reports_model->getReportById($id);
        if (!$report) {
            throw new HttpNotFoundException($request, "Report not found");
        }

        $filters = $this->getFilters($request, $this->reports_model, [
            'crime_code',
            'crime_desc'
        ]);

        $rules = [
            'description' => ['optional', 'ascii']
        ];

        $validated = $this->validateData($filters, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        // Get the crimes
        $crimes = $this->reports_model->getReportCrimes($id, $filters);

        // Send the response
        return $this->prepareOkResponse($response, (array) $crimes);
    }

    public function handleGetReportModus(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Make sure the report exists
        $report = $this->reports_model->getReportById($id);
        if (!$report) {
            throw new HttpNotFoundException($request, "Report not found");
        }

        $filters = $this->getFilters($request, $this->reports_model, [
            'mo_code',
            'mo_desc'
        ]);

        $rules = [
            'description' => ['optional', 'ascii']
        ];

        $validated = $this->validateData($filters, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        // Get the modi
        $modi = $this->reports_model->getReportModi($id, $filters);

        // Send the response
        return $this->prepareOkResponse($response, (array) $modi);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Response $response
     * @param array $uri_args
     * @return void
     */
    public function handleGetReportWeather(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Make sure the report exists
        $report = $this->reports_model->getReportById($id);
        if (!$report) {
            throw new HttpNotFoundException($request, "Report not found");
        }

        $weather_rules = [
            "temperature_unit" => [
                'optional',
                'alpha',
                ['in', ['celsius', 'fahrenheit']]
            ],
            "precipitation_unit" => [
                'optional',
                'alpha',
                ['in', ['mm', 'inch']]
            ]
        ];

        $filters = $request->getQueryParams();

        // Find the report
        $report = $this->reports_model->getReportById($id);
        if (!$report)
            throw new HttpNotFoundException($request, 'Report not found');
        $time = $report['incident']['occurred_time'];
        $pattern = '/(\d{4}-\d{2}-\d{2}) (\d{2}):\d{2}:\d{2}/';
        preg_match($pattern, $time, $date_hour);

        $query = [
            'latitude' => $report['location']['latitude'],
            'longitude' => $report['location']['longitude'],
            'start_date' => $date_hour[1],
            'end_date' => $date_hour[1],
            'hourly' => 'temperature_2m,precipitation,weathercode,relative_humidity_2m',
            'timezone' => 'America/Los_Angeles'
        ];

        $validated = $this->validateData($filters, $weather_rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        if (isset($filters['temperature_unit']))
            $query['temperature_unit'] = $filters['temperature_unit'];
        if (isset($filters['precipitation_unit']))
            $query['precipitation_unit'] = $filters['precipitation_unit'];

        $params = [
            'query' => $query
        ];
        $client = new GuzzleClient(['base_uri' => 'https://archive-api.open-meteo.com/']);
        $data = json_decode($client->request('GET', '/v1/archive', $params)->getBody(), true);
        unset($data['hourly_units']['time']);

        $weather = [
            'hourly_units' => $data['hourly_units'],
            'temperature' => $data['hourly']['temperature_2m'][intval($date_hour[2] - 1)],
            'precipitation' => $data['hourly']['precipitation'][intval($date_hour[2] - 1)],
            'humidity' => $data['hourly']['relative_humidity_2m'][intval($date_hour[2] - 1)],
            'weather_name' => $this->reports_model->toWeather($data['hourly']['weathercode'][intval($date_hour[2] - 1)])
        ];
        // Send the response
        return $this->prepareOkResponse($response, (array) $weather);
    }

    public function handleCreateReports(Request $request, Response $response, array $uri_args)
    {
        $report = $request->getParsedBody();

        // Validate the report
        $validated = $this->validateReport($report);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        $report_id = $this->reports_model->createReport($report);
        if (!$report_id)
            throw new HttpBadRequestException($request, "Failed to create report");

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Report inserted successfully"
        ];

        return $this->prepareOkResponse($response, $response_data, HttpCodes::STATUS_CREATED);
    }

    public function handleUpdateReports(Request $request, Response $response, array $uri_args)
    {
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0)) {
            throw new HttpBadRequestException($request, "Invalid ID");
        }

        // Make sure the report exists
        $report = $this->reports_model->getReportById($id);
        if (!$report) {
            throw new HttpNotFoundException($request, "Report not found");
        }

        $report = $request->getParsedBody();

        // Validate the report
        $validated = $this->validateReport($report);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        $success = $this->reports_model->updateReport($report, $id);
        if (!$success)
            throw new HttpBadRequestException($request, "Failed to update report");

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Report updated successfully"
        ];

        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleDeleteReports(Request $request, Response $response, array $uri_args)
    {
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0)) {
            throw new HttpBadRequestException($request, "Invalid ID");
        }

        // Make sure the report exists
        $report = $this->reports_model->getReportById($id);
        if (!$report) {
            throw new HttpNotFoundException($request, "Report not found");
        }

        $success = $this->reports_model->deleteReport($id);
        if (!$success)
            throw new HttpBadRequestException($request, "Failed to delete report");

        $response_data = [
            "code" => HttpCodes::STATUS_OK,
            "message" => "Report deleted successfully"
        ];

        return $this->prepareOkResponse($response, (array) $response_data);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Response $response
     * @param array $uri_args
     * @return void
     */
    public function handleGetReportDistance(Request $request, Response $response, array $uri_args)
    {
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0)) {
            throw new HttpBadRequestException($request, "Invalid ID");
        }

        $params = $request->getQueryParams();
        $rules = [
            'to' => ['required', 'integer', ['min', 1]],
            'unit' => ['optional', ['in', ['km', 'mi']]]
        ];

        // Validate parameters
        $validated = $this->validateData($params, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        // Find coordinates
        $from = $this->reports_model->getReportById($id);
        $to = $this->reports_model->getReportById($params['to']);

        if (!$from || !$to) {
            throw new HttpNotFoundException($request, "Report not found");
        }

        // Extract coordinates
        $from_lat = $from['location']['latitude'];
        $from_long = $from['location']['longitude'];

        $to_lat = $to['location']['latitude'];
        $to_long = $to['location']['longitude'];

        $unit = isset($params['unit']) ? $params['unit'] : 'km';
        $distance = $this->distanceCalc($from_lat, $from_long, $to_lat, $to_long);

        // Miles conversion
        if ($unit == 'mi') {
            $distance *= 0.621371;
        }

        // Prepare response
        $distance = round($distance, 4);
        $response_data = [
            "code" => HttpCodes::STATUS_OK,
            "message" => "Distance calculated successfully",
            "distance" => $distance,
            "unit" => $unit
        ];

        return $this->prepareOkResponse($response, (array) $response_data);
    }

    /**
     * Function to calculate the distance between two points on a globe
     *
     * @param float $from_lat Origin latitude
     * @param float $from_long Origin longitude
     * @param float $to_lat Destination latitude
     * @param float $to_long Destination longitude
     * @return float Distance between the two points
     */
    private function distanceCalc($from_lat, $from_long, $to_lat, $to_long)
    {
        $earth_radius = 6371;
        $dLat = deg2rad($to_lat - $from_lat);
        $dLon = deg2rad($to_long - $from_long);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($from_lat)) * cos(deg2rad($to_lat)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));

        $result = $earth_radius * $c;
        return $result;
    }
}
