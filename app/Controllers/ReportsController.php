<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\ReportsModel;

class ReportsController extends BaseController
{
    private $reports_model;

    public function __construct() {
        $this->reports_model = new ReportsModel();
    }

    public function handleGetReports(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();

        $page = $filters['page'] ?? 1;
        $page_size = $filters['page_size'] ?? 10;

        $this->reports_model->setPaginationOptions($page, $page_size);
        $reports = $this->reports_model->getAllReports($filters);

        return $this->prepareOkResponse($response, (array) $reports);
    }

    public function handleGetReportById(Request $request, Response $response, array $uri_args)
    {
        // Throwing an exception
        $id = $uri_args['report_id'];
        if (!Input::isInt($id))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $report = $this->reports_model->getReportById($id);
        //step 3) send the response
        return $this->prepareOkResponse($response, (array) $report);
    }

    public function handleGetReportVictims(Request $request, Response $response, array $uri_args)
    {
        // Throwing an exception
        $id = $uri_args['report_id'];
        if (!Input::isInt($id))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $report = $this->reports_model->getReportVictims($id);
        //step 3) send the response
        return $this->prepareOkResponse($response, (array) $report);
    }
    
    public function handleGetReportCriminals(Request $request, Response $response, array $uri_args)
    {
        // Throwing an exception
        $id = $uri_args['report_id'];
        if (!Input::isInt($id))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $report = $this->reports_model->getReportCriminals($id);
        //step 3) send the response
        return $this->prepareOkResponse($response, (array) $report);
    }
    
    public function handleGetReportPolice(Request $request, Response $response, array $uri_args)
    {
        // Throwing an exception
        $id = $uri_args['report_id'];
        if (!Input::isInt($id))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $report = $this->reports_model->getReportPolice($id);
        //step 3) send the response
        return $this->prepareOkResponse($response, (array) $report);
    }
    
    public function handleGetReportCrimes(Request $request, Response $response, array $uri_args)
    {
        // Throwing an exception
        $id = $uri_args['report_id'];
        if (!Input::isInt($id))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $report = $this->reports_model->getReportCrimes($id);
        //step 3) send the response
        return $this->prepareOkResponse($response, (array) $report);
    }

    public function handleGetReportModus(Request $request, Response $response, array $uri_args)
    {
        // Throwing an exception
        $id = $uri_args['report_id'];
        if (!Input::isInt($id))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $report = $this->reports_model->getReportModi($id);
        //step 3) send the response
        return $this->prepareOkResponse($response, (array) $report);
    }    

    public function handleCreateReports(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleUpdateReports(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeleteReports(Request $request, Response $response, array $uri_args)
    {
        $reports = $request->getParsedBody();
        foreach ($reports as $id => $report) {
            $this->reports_model->deleteReport($reports);
        }

		return $this->prepareOkResponse($response, (array) $reports);
    }
}