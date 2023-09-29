<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\CriminalsModel;

class CriminalsController extends BaseController
{
    private $criminals_model;

    public function __construct() {
        $this->criminals_model = new CriminalsModel();
    }

    public function handleGetCriminals(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();

        $page = $filters['page'] ?? 1;
        $page_size = $filters['page_size'] ?? 10;

        $this->criminals_model->setPaginationOptions($page, $page_size);
        $criminals = $this->criminals_model->getAllCriminals($filters);

        return $this->prepareOkResponse($response, (array) $criminals);
    }

    public function handleGetCriminalById(Request $request, Response $response, array $uri_args)
    {
        // Throwing an exception
        $id = $uri_args['criminal_id'];
        if (!Input::isInt($id))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $criminal = $this->criminals_model->getCriminalById($id);
        //step 3) send the response
        return $this->prepareOkResponse($response, (array) $criminal);
    }

    public function handleCreateCriminals(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleUpdateCriminals(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeleteCriminals(Request $request, Response $response, array $uri_args)
    {
        $criminals = $request->getParsedBody();
        foreach ($criminals as $id => $criminals) {
            $this->criminals_model->deleteCriminal($criminals);
        }
		return $this->prepareOkResponse($response, (array) $criminals);
    }
}