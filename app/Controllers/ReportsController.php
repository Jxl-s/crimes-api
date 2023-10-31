<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\ReportsModel;

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

        // Get the ID
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Get the victims
        $victims = $this->reports_model->getReportVictims($id, $filters);

        // Send the response
        return $this->prepareOkResponse($response, (array) $victims);
    }

    public function handleGetReportCriminals(Request $request, Response $response, array $uri_args)
    {
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

        // Get the ID
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Get the criminals
        $criminals = $this->reports_model->getReportCriminals($id, $filters);

        // Send the response
        return $this->prepareOkResponse($response, (array) $criminals);
    }

    public function handleGetReportPolice(Request $request, Response $response, array $uri_args)
    {
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

        // Get the ID
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Get the police officers
        $police = $this->reports_model->getReportPolice($id, $filters);

        // Send the response
        return $this->prepareOkResponse($response, (array) $police);
    }

    public function handleGetReportCrimes(Request $request, Response $response, array $uri_args)
    {
        $filters = $this->getFilters($request, $this->reports_model, [
            'crime_code',
            'crime_desc'
        ]);

        // Get the ID
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

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

        // Get the ID
        $id = $uri_args['report_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Get the modi
        $modi = $this->reports_model->getReportModi($id, $filters);

        // Send the response
        return $this->prepareOkResponse($response, (array) $modi);
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

        $success = $this->reports_model->deleteReport($id);
        if (!$success)
            throw new HttpBadRequestException($request, "Failed to delete report");

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Report deleted successfully"
        ];

        return $this->prepareOkResponse($response, (array) $response_data);
    }
}
