<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
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
        $filters = $request->getQueryParams();

        $page = $filters['page'] ?? 1;
        $page_size = $filters['page_size'] ?? 10;

        $this->districts_model->setPaginationOptions($page, $page_size);
        $districts = $this->districts_model->getAllDistricts($filters);

        return $this->prepareOkResponse($response, (array) $districts);
    }

    public function handleGetDistrictById(Request $request, Response $response, array $uri_args)
    {
        // Throwing an exception
        $id = $uri_args['district_id'];
        if (!Input::isInt($id))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $district = $this->districts_model->getDistrictById($id);
        //step 3) send the response
        return $this->prepareOkResponse($response, (array) $district);
    }
    
    public function handleCreateDistricts(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleUpdateDistricts(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeleteDistricts(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }
}