<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\CrimesModel;


class CrimesController extends BaseController
{
    private $crimes_model;

    public function __construct()
    {
        $this->crimes_model = new CrimesModel();
    }

    public function handleGetCrimes(Request $request, Response $response, array $uri_args)
    {
        $filters = $this->getFilters($this->crimes_model, $request);
        $crimes = $this->crimes_model->getAllCrimes($filters);

        return $this->prepareOkResponse($response, (array) $crimes);
    }

    public function handleGetCrimeByCode(Request $request, Response $response, array $uri_args)
    {
        // Get the code
        $code = $uri_args['crime_code'];
        if (!Input::isInt($code, 0))
            throw new HttpBadRequestException($request, "Invalid Code");

        // Find the crime
        $crime = $this->crimes_model->getCrimeByCode($code);
        if (!$crime)
            throw new HttpNotFoundException($request, "Crimes Not Found");

        // Send the response
        return $this->prepareOkResponse($response, (array) $crime);
    }

    public function handleCreateCrimes(Request $request, Response $response, array $uri_args)
    {
        $crime = $request->getParsedBody();

        //if an array given, throw exception    
        if (isset($crime[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');

        //TODO: Validate Data
        $this->crimes_model->createCrime($crime);

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateCrimes(Request $request, Response $response, array $uri_args)
    {
        $code = $uri_args['crime_code'];
        $crime = $request->getParsedBody();
        $this->crimes_model->updateCrime($crime, $code);
        return $this->prepareOkResponse($response, (array) $crime);
    }

    public function handleDeleteCrimes(Request $request, Response $response, array $uri_args)
    {
        $code = $uri_args['crime_code'];
        $this->crimes_model->deleteCrime($code);
        return $this->prepareOkResponse($response, (array) $code);
    }
}
