<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\PoliceModel;

class PoliceController extends BaseController
{
    private $police_model;

    public function __construct() {
        $this->police_model = new PoliceModel();
    }

    public function handleGetPolice(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();

        $page = $filters['page'] ?? 1;
        $page_size = $filters['page_size'] ?? 10;

        $this->police_model->setPaginationOptions($page, $page_size);
        $police = $this->police_model->getAllPolice($filters);

        return $this->prepareOkResponse($response, (array) $police);
    }

    public function handleGetPoliceById(Request $request, Response $response, array $uri_args)
    {
        // Throwing an exception
        $id = $uri_args['badge_id'];
        if (!Input::isInt($id))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $police = $this->police_model->getPoliceById($id);
        //step 3) send the response
        return $this->prepareOkResponse($response, (array) $police);
    }
    
    public function handleCreatePolice(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleUpdatePolice(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeletePolice(Request $request, Response $response, array $uri_args)
    {
        $police = $request->getParsedBody();
        foreach ($police as $id => $police_off) {
            $this->police_model->deletePolice($police_off);
        }
		return $this->prepareOkResponse($response, (array) $police);
    }
}