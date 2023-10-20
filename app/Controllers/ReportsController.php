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

        //if an array given, throw exception    
        if (isset($report[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');

        //TODO: Validate Data
        $this->reports_model->createReport($report);

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];

        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateReports(Request $request, Response $response, array $uri_args)
    {
        $id = $uri_args['report_id'];
        $report = $request->getParsedBody();
        $this->reports_model->updateReport($report, $id);
        return $this->prepareOkResponse($response, (array) $id);
    }

    public function handleDeleteReports(Request $request, Response $response, array $uri_args)
    {
        $report = $uri_args['report_id'];
        $this->reports_model->deleteReport($report);
        return $this->prepareOkResponse($response, (array) $report);
    }
}
