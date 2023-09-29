<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\CrimesModel;


class CrimesController extends BaseController
{
    private $crimes_model;

    public function __construct() {
        $this->crimes_model = new CrimesModel();
    }

    public function handleGetCrimes(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();

        $page = $filters['page'] ?? 1;
        $page_size = $filters['page_size'] ?? 10;

        $this->crimes_model->setPaginationOptions($page, $page_size);
        $crimes = $this->crimes_model->getAllCrimes($filters);

        return $this->prepareOkResponse($response, (array) $crimes);
    }

    public function handleGetCrimeByCode(Request $request, Response $response, array $uri_args)
    {
        // Throwing an exception
        $code = $uri_args['crime_code'];
        if (!Input::isInt($code))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $crime = $this->crimes_model->getCrimeByCode($code);
        //step 3) send the response
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