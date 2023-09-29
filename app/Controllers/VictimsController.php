<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\VictimsModel;

class VictimsController extends BaseController
{
    private $victims_model;

    public function __construct() {
        $this->victims_model = new VictimsModel();
    }

    public function handleGetVictims(Request $request, Response $response, array $uri_args)
    {
        $filters = $this->getFilters($this->victims_model, $request);
        $victims = $this->victims_model->getAllVictims($filters);

        return $this->prepareOkResponse($response, (array) $victims);
    }

    public function handleGetVictimById(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['victim_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid Code");
        
        // Find the victim
        $victim = $this->victims_model->getVictimById($id);
        if (!$victim)
            throw new HttpNotFoundException($request, 'Victim Not Found');

        // Send the response
        return $this->prepareOkResponse($response, (array) $victim);
    }
    
    public function handleCreateVictims(Request $request, Response $response, array $uri_args)
    {
        $victims = $request->getParsedBody();
        
        foreach ($victims as $id => $victim) {
            $this->victims_model->createVictim($victim);
        }

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];

        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateVictims(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeleteVictims(Request $request, Response $response, array $uri_args)
    {
        $victims = $request->getParsedBody();
        foreach ($victims as $id => $victim) {
            $this->victims_model->deleteVictim($victim);
        }
		return $this->prepareOkResponse($response, (array) $victim);
    }

}