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
        $get_rules = array(
            'description' => [
                'optional',
                'ascii',
                ['lengthMax', 50]
            ]
        );
        $filters = $this->getFilters($request, $this->crimes_model, ['crime_code', 'crime_desc']);
        if($this->validateData($filters, $get_rules) === true) {
            $crimes = $this->crimes_model->getAllCrimes($filters);

            return $this->prepareOkResponse($response, (array) $crimes);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($filters, $get_rules));
        }
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
            throw new HttpNotFoundException($request, "Crime Not Found");

        // Send the response
        return $this->prepareOkResponse($response, (array) $crime);
    }

    public function handleCreateCrimes(Request $request, Response $response, array $uri_args)
    {
        $post_rules = array(
            'crime_code' => [
                'required',
                'integer'
            ],
            'crime_desc' => [
                'required',
                ['lengthMax', 50]
            ]
        );
        $crime = (array) $request->getParsedBody();

        //if an array given, throw exception    
        if (isset($crime[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time.');

        //TODO: Validate Data
        if($this->validateData($crime, $post_rules) === true) {
            $this->crimes_model->createCrime($crime);

            $response_data = [
                "code" => HttpCodes::STATUS_CREATED,
                "message" => "Inserted Successfully"
            ];
            return $this->prepareOkResponse($response, $response_data);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($crime, $post_rules));
        }
    }

    public function handleUpdateCrimes(Request $request, Response $response, array $uri_args)
    {
        $put_rules = array(
            'crime_code' => [
                'integer'
            ],
            'crime_desc' => [
                ['lengthMax', 50]
            ]
        );
        $code = $uri_args['crime_code'];
        if (!Input::isInt($code, 0))
            throw new HttpBadRequestException($request, "Invalid Code");
        $crime = (array) $request->getParsedBody();
        if (isset($crime[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');
        if($this->validateData($crime, $put_rules) === true) {
            $this->crimes_model->updateCrime($crime, $code);
            return $this->prepareOkResponse($response, (array) $crime);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($crime, $put_rules));
        }
    }

    public function handleDeleteCrimes(Request $request, Response $response, array $uri_args)
    {
        $code = $uri_args['crime_code'];
        if (!Input::isInt($code, 0))
            throw new HttpBadRequestException($request, "Invalid Code");
        $this->crimes_model->deleteCrime($code);
        return $this->prepareOkResponse($response, (array) $code);
    }
}
