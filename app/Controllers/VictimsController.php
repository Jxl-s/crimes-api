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

    public function __construct()
    {
        $this->victims_model = new VictimsModel();
    }

    public function handleGetVictims(Request $request, Response $response, array $uri_args)
    {
        $filters = $this->getFilters($request, $this->victims_model, ['victim_id', 'first_name', 'last_name', 'age', 'height']);

        $rules = [
            'first_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'last_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'age' => ['optional', 'integer'],
            'descent' => ['optional', 'alpha', ['length', 1]],
            'sex' => ['optional', ['length', 1], ['in', ['M', 'F', 'X']]]
        ];

        $validated = $this->validateData($filters, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

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
        $victim = $request->getParsedBody();
        //if an array given, throw exception    
        echo gettype($victim);
        if (isset($victim[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');

        $rules = [
            'first_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'last_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'age' => ['optional', 'integer'],
            'descent' => ['optional', 'alpha', ['length', 1]],
            'sex' => ['optional', ['length', 1], ['in', ['M', 'F', 'X']]]
        ];

        $validated = $this->validateData((array) $victim, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        $this->victims_model->createVictim($victim);

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];

        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateVictims(Request $request, Response $response, array $uri_args)
    {
        $id = $uri_args['victim_id'];
        $victim = $request->getParsedBody();
        if (isset($victim[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');

        $rules = [
            'first_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'last_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'age' => ['optional', 'integer'],
            'descent' => ['optional', 'alpha', ['length', 1]],
            'sex' => ['optional', ['length', 1], ['in', ['M', 'F', 'X']]]
        ];

        $validated = $this->validateData((array )$victim, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        $this->victims_model->updateVictim($victim, $id);
        return $this->prepareOkResponse($response, (array) $victim);
    }

    public function handleDeleteVictims(Request $request, Response $response, array $uri_args)
    {
        // Get the ID. Cast 
        $victim = $uri_args['victim_id'];
        $this->victims_model->deleteVictim($victim);
        return $this->prepareOkResponse($response, (array) $victim);
    }
}
