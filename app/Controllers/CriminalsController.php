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
        $filters = $this->getFilters($this->criminals_model, $request);
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

    public function handleCreateCriminals(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleUpdateCriminals(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeleteCriminals(Request $request, Response $response, array $uri_args)
    {
        $criminals = $request->getParsedBody();
        foreach ($criminals as $id => $criminals) {
            $this->criminals_model->deleteCriminal($criminals);
        }
        return $this->prepareOkResponse($response, (array) $criminals);
    }
}
