<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\DistrictsModel;

class DistrictsController extends BaseController
{
    private $districts_model;

    public function __construct()
    {
        $this->districts_model = new DistrictsModel();
    }

    public function handleGetDistricts(Request $request, Response $response, array $uri_args)
    {
        $get_rules = array(
            'bureau' => [
                ['length', 20]
            ],
            'precinct' => [
                'integer'
            ]
        );
        $filters = $this->getFilters($request, $this->districts_model, ['district_id', 'st_name', 'bureau', 'precinct', 'omega_label', 'station']);
        if($this->validateData($filters, $get_rules) === true) {
            $districts = $this->districts_model->getAllDistricts($filters);

            return $this->prepareOkResponse($response, (array) $districts);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($get_rules, $filters));
        }
    }

    public function handleGetDistrictById(Request $request, Response $response, array $uri_args)
    {

        // Get the ID
        $id = $uri_args['district_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid District Id");

        // Find the district
        $district = $this->districts_model->getDistrictById($id);
        if (!$district)
            throw new HttpNotFoundException($request, 'District Not Found');

        // Send the response
        return $this->prepareOkResponse($response, (array) $district);
    }

    public function handleGetDistrictReports(Request $request, Response $response, array $uri_args)
    {
        $get_rules = array(
            'from_last_update' => [
                ['dateFormat', 'Y-m-d'],
                'date'
            ],
            'to_last_update' => [
                ['dateFormat', 'Y-m-d'],
                'date'
            ],
            'fatalities' => [
                'integer'
            ],
            'premise' => [
                ['lengthMax', 50]
            ]        
        );
        $filters = $this->getFilters($request, $this->districts_model, ['report_id', 'last_update', 'fatalities', 'premise']);
        $district_id = $uri_args['district_id'];
        if (!Input::isInt($district_id, 0))
            throw new HttpBadRequestException($request, "Invalid Code");
        if($this->validateData($filters, $get_rules) === true) {
            $reports = $this->districts_model->getDistrictReports($district_id, $filters);
            if (!$reports)
                throw new HttpNotFoundException($request, 'Reports Not Found');
            return $this->prepareOkResponse($response, (array) $reports);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($get_rules, $filters));
        }
    }

    public function handleGetDistrictPolice(Request $request, Response $response, array $uri_args)
    {
        $get_rules = array(
            'first_name' => [
                ['lengthMax', 50]
            ],
            'last_name' => [
                ['lengthMax', 50]
            ],
            'from_join_date' => [
                ['dateFormat', 'Y-m-d'],
                'date'
            ],
            'to_join_date' => [
                ['dateFormat', 'Y-m-d'],
                'date'
            ],
            'rank' => [
                ['lengthMax', 20]
            ],
        );
        $filters = $this->getFilters($request, $this->districts_model, ['first_name', 'first_name', 'join_date', 'rank']);
        $district_id = $uri_args['district_id'];
        if (!Input::isInt($district_id, 0))
            throw new HttpBadRequestException($request, "Invalid Code");
        if($this->validateData($filters, $get_rules) === true) {
            $police = $this->districts_model->getDistrictPolice($district_id, $filters);
            if (!$police)
                throw new HttpNotFoundException($request, 'Police Not Found');
            return $this->prepareOkResponse($response, (array) $police);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($get_rules, $filters));
        }
    }

    public function handleCreateDistricts(Request $request, Response $response, array $uri_args)
    {
        $district = $request->getParsedBody();

        //if an array given, throw exception
        if (isset($district[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');

        //TODO: Validate contents
        $this->districts_model->createDistrict($district);

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateDistricts(Request $request, Response $response, array $uri_args)
    {
        $id = $uri_args['district_id'];
        $district = $request->getParsedBody();
        $this->districts_model->updateDistrict($district, $id);
        return $this->prepareOkResponse($response, (array) $district);
    }

    public function handleDeleteDistricts(Request $request, Response $response, array $uri_args)
    {
        $district = $uri_args['district_id'];
        $this->districts_model->deleteDistrict($district);
        return $this->prepareOkResponse($response, (array) $district);
    }
}
