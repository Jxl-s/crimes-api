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
                'optional',
                'ascii',
                ['lengthMax', 20]
            ],
            'precinct' => [
                'optional',
                'integer'
            ]
        );
        $filters = $this->getFilters($request, $this->districts_model, ['district_id', 'st_name', 'bureau', 'precinct', 'omega_label', 'station']);
        if($this->validateData($filters, $get_rules) === true) {
            $districts = $this->districts_model->getAllDistricts($filters);

            return $this->prepareOkResponse($response, (array) $districts);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($filters, $get_rules));
        }
    }

    public function handleGetDistrictById(Request $request, Response $response, array $uri_args)
    {

        // Get the ID
        $id = $uri_args['district_id'];

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
                'optional',
                ['dateFormat', 'Y-m-d'],
                'date'
            ],
            'to_last_update' => [
                'optional',
                ['dateFormat', 'Y-m-d'],
                'date'
            ],
            'fatalities' => [
                'optional',
                'integer'
            ],
            'premise' => [
                'optional',
                'ascii',
                ['lengthMax', 50]
            ]        
        );
        $filters = $this->getFilters($request, $this->districts_model, ['report_id', 'last_update', 'fatalities', 'bureau', 'premise']);
        $district_id = $uri_args['district_id'];

        if($this->validateData($filters, $get_rules) === true) {
            $reports = $this->districts_model->getDistrictReports($district_id, $filters);
            return $this->prepareOkResponse($response, (array) $reports);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($filters, $get_rules));
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
        if($this->validateData($filters, $get_rules) === true) {
            $police = $this->districts_model->getDistrictPolice($district_id, $filters);
            return $this->prepareOkResponse($response, (array) $police);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($filters, $get_rules));
        }
    }

    public function handleCreateDistricts(Request $request, Response $response, array $uri_args)
    {
        
        $district = (array) $request->getParsedBody();
        $create_rules = array(
            'district_id' => [
                'required',
                'integer'
            ],
            'st_name' => [
                'required',
                'ascii',
                ['lengthMax', 20]
            ],
            'bureau' => [
                'required',
                'ascii',
                ['lengthMax', 20]
            ],
            'precinct' => [
                'required',
                'integer'
            ],
            'omega_label' => [
                'required',
                'ascii',
                ['lengthMax', 20]
            ],
            'station' => [
                'required',
                'ascii',
                ['lengthMax', 20]
            ],
        );

        //if an array given, throw exception
        if (isset($district[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');
        //TODO: Validate contents
        if($this->validateData($district, $create_rules) === true) {
            $this->districts_model->createDistrict($district);
            $response_data = [
                "code" => HttpCodes::STATUS_CREATED,
                "message" => "Inserted Successfully"
            ];
            return $this->prepareOkResponse($response, $response_data);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($district, $create_rules));
        }
    } 

    public function handleUpdateDistricts(Request $request, Response $response, array $uri_args)
    {
        $district_id = $uri_args['district_id'];

        $district = $this->districts_model->getDistrictById($district_id);
        if(!$district)
            throw new HttpNotFoundException($request, "District not found");
            
        $district = (array) $request->getParsedBody();
        $update_rules = array(
            'st_name' => [
                'required',
                'ascii',
                ['lengthMax', 20]
            ],
            'bureau' => [
                'required',
                'ascii',
                ['lengthMax', 20]
            ],
            'precinct' => [
                'required',
                'integer'
            ],
            'omega_label' => [
                'required',
                'ascii',
                ['lengthMax', 20]
            ],
            'station' => [
                'required',
                'ascii',
                ['lengthMax', 20]
            ],
        );
        if (isset($district[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');
        if($this->validateData($district, $update_rules) === true) {
            $success = $this->districts_model->updateDistrict($district, $district_id);
            if (!$success)
                throw new HttpBadRequestException($request, "Failed to update district");
            $response_data = [
                "code" => HttpCodes::STATUS_CREATED,
                "message" => "Updated Successfully"
            ];
            return $this->prepareOkResponse($response, $response_data);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($district, $update_rules));
        }
    }

    public function handleDeleteDistricts(Request $request, Response $response, array $uri_args)
    {
        $district_id = $uri_args['district_id'];
            
        $district = $this->districts_model->getDistrictById($district_id);

        if(!$district)
            throw new HttpNotFoundException($request, "District not found");

        $success = $this->districts_model->deleteDistrict($district_id);
        if (!$success)
            throw new HttpBadRequestException($request, "Failed to delete district");
        
        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Deleted Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }
}
