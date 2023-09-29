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
        $crimes = $request->getParsedBody();

        //TODO: Validate contents

        foreach ($crimes as $id => $crime) {
            $this->crimes_model->createCrime($crime);
        }

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateCrimes(Request $request, Response $response, array $uri_args)
    {

        return $response;
    }

    public function handleDeleteCrimes(Request $request, Response $response, array $uri_args)
    {
        $crimes = $request->getParsedBody();
        foreach ($crimes as $id => $crime) {
            $this->crimes_model->deleteCrime($crime);
        }
        return $this->prepareOkResponse($response, (array) $crimes);
    }
}
