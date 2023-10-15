<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\ModiModel;

class ModiController extends BaseController
{
    private $modi_model;

    public function __construct()
    {
        $this->modi_model = new ModiModel();
    }

    public function handleGetModi(Request $request, Response $response, array $uri_args)
    {
        $filters = $this->getFilters($request, $this->modi_model, ['mo_code', 'mo_desc']);
        $modi = $this->modi_model->getAllModi($filters);

        return $this->prepareOkResponse($response, (array) $modi);
    }

    public function handleGetModiByCode(Request $request, Response $response, array $uri_args)
    {
        // Get the code
        $code = $uri_args['mo_code'];

        // Find the modus
        $modus = $this->modi_model->getModusByCode($code);
        if (!$modus)
            throw new HttpNotFoundException($request, 'Modus Not Found');

        // Send the response
        return $this->prepareOkResponse($response, (array) $modus);
    }

    public function handleCreateModi(Request $request, Response $response, array $uri_args)
    {
        $modi = $request->getParsedBody();

        //if an array given, throw exception
        if (isset($modi[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');

        //TODO: Validate contents
        $this->modi_model->createModus($modi);

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateModi(Request $request, Response $response, array $uri_args)
    {
        $code = $uri_args['mo_code'];
        $desc = $request->getParsedBody();
        $this->modi_model->updateModus($desc, $code);
        return $this->prepareOkResponse($response, (array) $desc);
    }

    public function handleDeleteModi(Request $request, Response $response, array $uri_args)
    {
        $modus = $uri_args['mo_code'];
        $this->modi_model->deleteModus($modus);
        return $this->prepareOkResponse($response, (array) $modus);
    }
}
