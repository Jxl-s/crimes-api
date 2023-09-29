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

    public function __construct() {
        $this->districts_model = new DistrictsModel();
    }

    public function handleGetDistricts(Request $request, Response $response, array $uri_args)
    {
        $filters = $this->getFilters($this->districts_model, $request);
        $districts = $this->districts_model->getAllDistricts($filters);

        return $this->prepareOkResponse($response, (array) $districts);
    }

    public function handleGetDistrictById(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['district_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid Code");
        
        // Find the district
        $district = $this->districts_model->getDistrictById($id);
        if (!$district)
            throw new HttpNotFoundException($request, 'District Not Found');

        // Send the response
        return $this->prepareOkResponse($response, (array) $district);
    }
    
    public function handleCreateDistricts(Request $request, Response $response, array $uri_args)
    {
        $districts = $request->getParsedBody();
        
        //TODO: Validate contents

        foreach ($districts as $id => $district) {
            $this->districts_model->createDistrict($district);
        }

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateDistricts(Request $request, Response $response, array $uri_args)
    {
        $districts = $request->getParsedBody();
        foreach ($districts as $id => $district) {
            $this->districts_model->updateDistrict($district, $district["district_id"]);
        }
        return $this->prepareOkResponse($response, (array) $districts);
    }

    public function handleDeleteDistricts(Request $request, Response $response, array $uri_args)
    {
        $districts = $request->getParsedBody();
        foreach ($districts as $id => $district) {
            $this->districts_model->deleteDistrict($district);
        }
		return $this->prepareOkResponse($response, (array) $districts);
    }
}