<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\CriminalsModel;

class CriminalsController extends BaseController
{
    private $criminals_model;

    public function __construct()
    {
        $this->criminals_model = new CriminalsModel();
    }

    public function handleGetCriminals(Request $request, Response $response, array $uri_args)
    {
        $filters = $this->getFilters($request, $this->criminals_model, ['criminal_id', 'first_name', 'last_name', 'age', 'height']);
        $criminals = $this->criminals_model->getAllCriminals($filters);

        return $this->prepareOkResponse($response, (array) $criminals);
    }

    public function handleGetCriminalById(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['criminal_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Find the criminal
        $criminal = $this->criminals_model->getCriminalById($id);
        if (!$criminal)
            throw new HttpNotFoundException($request, 'Criminal Not Found');

        // Send the response
        return $this->prepareOkResponse($response, (array) $criminal);
    }

    public function handleGetCriminalReports(Request $request, Response $response, array $uri_args)
    {
        // Get the filters
        $filters = $this->getFilters($request, $this->criminals_model, ['report_id', 'last_update', 'fatalities', 'premise',]);

        // Get the ID
        $id = $uri_args['criminal_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid Code");

        // Find all cases the given criminal involved in
        $reports = $this->criminals_model->getCriminalReports($id, $filters);

        // Send the response
        return $this->prepareOkResponse($response, (array) $reports);
    }

    public function handleCreateCriminals(Request $request, Response $response, array $uri_args)
    {
        $criminal = $request->getParsedBody();

        //if an array given, throw exception    
        if (isset($criminal[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');

        //TODO: Validate Data
        $this->criminals_model->createCriminal($criminal);

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];

        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateCriminals(Request $request, Response $response, array $uri_args)
    {
        $id = $uri_args['criminal_id'];
        $criminal = $request->getParsedBody();
        $this->criminals_model->updateCriminal($criminal, $id);
        return $this->prepareOkResponse($response, (array) $criminal);
    }

    public function handleDeleteCriminals(Request $request, Response $response, array $uri_args)
    {
        $criminal = $uri_args['criminal_id'];
        $this->criminals_model->deleteCriminal($criminal);
        return $this->prepareOkResponse($response, (array) $criminal);
    }
}
