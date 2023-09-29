<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\ModiModel;

class ModiController extends BaseController
{
    private $modi_model;

    public function __construct() {
        $this->modi_model = new ModiModel();
    }

    public function handleGetModi(Request $request, Response $response, array $uri_args)
    {
        $filters = $this->getFilters($this->modi_model, $request);
        $modi = $this->modi_model->getAllModi($filters);

        return $this->prepareOkResponse($response, (array) $modi);
    }

    public function handleGetModiByCode(Request $request, Response $response, array $uri_args)
    {
        $code = $uri_args['mo_code'];
        if (!Input::isInt((int) $code))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $modus = $this->modi_model->getModusByCode($code);
        //step 3) send the response
        return $this->prepareOkResponse($response, (array) $modus);
    }
    
    public function handleCreateModi(Request $request, Response $response, array $uri_args)
    {
        $modis = $request->getParsedBody();
        
        //TODO: Validate contents

        foreach ($modis as $id => $modi) {
            $this->modi_model->createModus($modi);
        }

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateModi(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeleteModi(Request $request, Response $response, array $uri_args)
    {
        $modi = $request->getParsedBody();
        foreach ($modi as $id => $modus) {
            $this->modi_model->deleteModus($modus);
        }
		return $this->prepareOkResponse($response, (array) $modi);
    }
}