<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\PoliceModel;
use Vanier\Api\Models\ReportsModel;

class PoliceController extends BaseController
{
    private $police_model;

    public function __construct()
    {
        $this->police_model = new PoliceModel();
    }

    public function handleGetPolice(Request $request, Response $response, array $uri_args)
    {
        $filters = $this->getFilters($request, $this->police_model, ['badge_id', 'first_name', 'last_name', 'join_date', 'rank']);
        $police = $this->police_model->getAllPolice($filters);

        return $this->prepareOkResponse($response, (array) $police);
    }

    public function handleGetPoliceById(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['badge_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid Code");

        // Find the police
        $police = $this->police_model->getPoliceById($id);
        if (!$police)
            throw new HttpNotFoundException($request, 'Police Not Found');

        // Send the response
        return $this->prepareOkResponse($response, (array) $police);
    }

    public function handleGetPoliceReports(Request $request, Response $response, array $uri_args)
    {
        // Get the filters
        $filters = $this->getFilters($request, new ReportsModel(), ['report_id', 'last_update', 'fatalities', 'premise',]);
        
        // Get the ID
        $id = $uri_args['badge_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid Code");

        // Find all cases the given police involved in
        $policeReport = $this->police_model->getPoliceReports($id, $filters);


        // Send the response
        return $this->prepareOkResponse($response, (array) $policeReport);
    }

    public function handleCreatePolice(Request $request, Response $response, array $uri_args)
    {
        $police = $request->getParsedBody();

        //if an array given, throw exception
        if (isset($police[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');

        //TODO: Validate contents
        $this->police_model->createPolice($police);

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdatePolice(Request $request, Response $response, array $uri_args)
    {
        $id = $uri_args['badge_id'];
        $police = $request->getParsedBody();
        $this->police_model->updatePolice($police, $id);
        return $this->prepareOkResponse($response, (array) $police);
    }

    public function handleDeletePolice(Request $request, Response $response, array $uri_args)
    {
        $police = $uri_args['badge_id'];
        $this->police_model->deletePolice($police);
        return $this->prepareOkResponse($response, (array) $police);
    }
}
