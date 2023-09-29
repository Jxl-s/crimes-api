<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
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
        // Throwing an exception
        $id = $uri_args['victim_id'];
        if (!Input::isInt($id))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $victim = $this->victims_model->getVictimById($id);
        //step 3) send the response
        return $this->prepareOkResponse($response, (array) $victim);
    }
    
    public function handleCreateVictims(Request $request, Response $response, array $uri_args)
    {
        return $response;
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