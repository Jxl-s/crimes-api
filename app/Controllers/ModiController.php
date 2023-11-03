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
        $get_rules = array(
            'description' => [
                'optional',
                'ascii',
                ['lengthMax', 50]
            ]
        );
        $filters = $this->getFilters($request, $this->modi_model, ['mo_code', 'description']);
        if($this->validateData($filters, $get_rules) === true) {
            $modi = $this->modi_model->getAllModi($filters);
            return $this->prepareOkResponse($response, (array) $modi);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($filters, $get_rules));
        }
    }

    public function handleGetModiByCode(Request $request, Response $response, array $uri_args)
    {
        // Get the code
        $code = $uri_args['mo_code'];
        if (!Input::isInt($code))
            throw new HttpBadRequestException($request, "Invalid Code");

        // Find the modus
        $modus = $this->modi_model->getModusByCode($code);
        if (!$modus)
            throw new HttpNotFoundException($request, 'Modus Not Found');

        // Send the response
        return $this->prepareOkResponse($response, (array) $modus);
    }

    public function handleCreateModi(Request $request, Response $response, array $uri_args)
    {
        $post_rules = array(
            'mo_code' => [
                'required',
                ['lengthMax', 10],
                ['regex', '/[0-9]{4}/']
            ],
            'description' => [
                'required',
                ['lengthMax', 50]
            ]
        );
        $modi = (array) $request->getParsedBody();

        if (isset($modi[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');

        //TODO: Validate contents
        if($this->validateData($modi, $post_rules) === true) {
            $this->modi_model->createModus($modi);

            $response_data = [
                "code" => HttpCodes::STATUS_CREATED,
                "message" => "Inserted Successfully"
            ];
            return $this->prepareOkResponse($response, $response_data);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($modi, $post_rules));
        }
    }

    public function handleUpdateModi(Request $request, Response $response, array $uri_args)
    {
        $put_rules = array(
            'description' => [
                'ascii',
                'optional',
                ['lengthMax', 50]
            ],
        );
        $code = $uri_args['mo_code'];
        $modus = $request->getParsedBody();
        if(isset($modus['mo_code'])) {
            unset($modus["mo_code"]);
        }
        if(isset($modus['description'])) {
            $modus['mo_desc'] = $modus['description'];
            unset($modus['description']);
        }
        if (isset($desc[0]))
            throw new HttpBadRequestException($request, 'Bad format provided. Please enter one record per time');
        if($this->validateData($modus, $put_rules) === true) {
            $this->modi_model->updateModus($modus, $code);

            $response_data = [
                "code" => HttpCodes::STATUS_CREATED,
                "message" => "Updated Successfully"
            ];
            return $this->prepareOkResponse($response, $response_data);
        } else {
            throw new HttpBadRequestException($request, $this->validateData($modus, $put_rules));
        }
    }

    public function handleDeleteModi(Request $request, Response $response, array $uri_args)
    {
        $modus = $uri_args['mo_code'];
        if (!Input::isIntInRange($modus, 0, 9999))
            throw new HttpBadRequestException($request, "Invalid Code");
        $this->modi_model->deleteModus($modus);
        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Deleted Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }
}
