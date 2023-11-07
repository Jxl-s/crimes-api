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
        $filters = $this->getFilters($request, $this->crimes_model, ['crime_code', 'description']);
        $validation = $this->validateData($filters, $get_rules);

        if ($validation === true) {
            $crimes = $this->crimes_model->getAllCrimes($filters);
            return $this->prepareOkResponse($response, (array) $crimes);
        } else {
            throw new HttpBadRequestException($request, $validation);
        }
    }

    public function handleGetCrimeByCode(Request $request, Response $response, array $uri_args)
    {
        // Get the code
        $code = $uri_args['crime_code'];

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
                'ascii',
                ['lengthMax', 50]
            ]
        );

        $crime = $request->getParsedBody();
        if (isset($crime[0]))
            throw new HttpBadRequestException($request, 'Bad format provided');
        if ($crime === null) {
            throw new HttpBadRequestException($request, 'Bad format provided. Please make sure no integer starts with 0');
        }
            
        $validation = $this->validateData((array) $crime, $post_rules);

        if ($validation !== true) {
            throw new HttpBadRequestException($request, $validation);
        }

        $this->crimes_model->createCrime($crime);
        
        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];

        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateCrimes(Request $request, Response $response, array $uri_args)
    {
        $put_rules = array(
            'crime_desc' => [
                'optional',
                ['lengthMax', 50]
            ]
        );

        $code = $uri_args['crime_code'];

        $crime = $request->getParsedBody();
        if (isset($crime[0]))
            throw new HttpBadRequestException($request, 'Bad format provided');

        
        $validation = $this->validateData((array) $crime, $put_rules);

        if ($validation !== true) {
            throw new HttpBadRequestException($request, $validation);
        }
        
        $success = $this->crimes_model->updateCrime($crime, $code);

        if (!$success)
            throw new HttpBadRequestException($request, "Update Failed");

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Updated Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleDeleteCrimes(Request $request, Response $response, array $uri_args)
    {
        $code = $uri_args['crime_code'];

        $success = $this->crimes_model->deleteCrime($code);
        if (!$success)
            throw new HttpBadRequestException($request, "Delete Failed");

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Deleted Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }
}
