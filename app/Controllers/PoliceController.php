<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\PoliceModel;

class PoliceController extends BaseController
{
    private $police_model;

    public function __construct() {
        $this->police_model = new PoliceModel();
    }

    public function handleGetPolice(Request $request, Response $response, array $uri_args)
    {
        $filters = $this->getFilters($this->police_model, $request);
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
        return $response;
    }
    
    public function handleCreatePolice(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleUpdatePolice(Request $request, Response $response, array $uri_args)
    {
        $police = $request->getParsedBody();
        foreach ($police as $id => $police_off) {
            $this->police_model->updatePolice($police_off, $police_off["badge_id"]);
        }
        return $this->prepareOkResponse($response, (array) $police_off);

    }

    public function handleDeletePolice(Request $request, Response $response, array $uri_args)
    {
        $police = $request->getParsedBody();
        foreach ($police as $id => $police_off) {
            $this->police_model->deletePolice($police_off);
        }
		return $this->prepareOkResponse($response, (array) $police);
    }
}