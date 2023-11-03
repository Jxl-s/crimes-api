<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\CriminalsModel;

class CriminalsController extends BaseController
{
    private $criminals_model;

    public function __construct()
    {
        $this->criminals_model = new CriminalsModel();
    }

    public function handleGetCriminals(Request $request, Response $response, array $uri_args)
    {
        $filters = $this->getFilters($request, $this->criminals_model, ['criminal_id', 'first_name', 'last_name', 'age', 'height']);

        $rules = [
            'first_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'last_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'age' => ['optional', 'integer'],
            'descent' => ['optional', 'alpha', ['length', 1]],
            'sex' => ['optional', ['length', 1], ['in', ['M', 'F', 'X']]],
            'is_arrested' => ['optional', ['length', 1], ['in', [0, 1]]]
        ];

        $validated = $this->validateData($filters, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        $criminals = $this->criminals_model->getAllCriminals($filters);

        return $this->prepareOkResponse($response, (array) $criminals);
    }

    public function handleGetCriminalById(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['criminal_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid ID");

        // Find the criminal
        $criminal = $this->criminals_model->getCriminalById($id);
        if (!$criminal)
            throw new HttpNotFoundException($request, 'Criminal Not Found');

        // Send the response
        return $this->prepareOkResponse($response, (array) $criminal);
    }

    public function handleGetCriminalReports(Request $request, Response $response, array $uri_args)
    {
        // Get the filters
        $filters = $this->getFilters($request, $this->criminals_model, ['report_id', 'last_update', 'fatalities', 'premise']);

        $rules = [
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
        ];

        $validated = $this->validateData($filters, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        // Get the ID
        $id = $uri_args['criminal_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid Code");

        // Find all cases the given criminal involved in
        $reports = $this->criminals_model->getCriminalReports($id, $filters);

        // Send the response
        return $this->prepareOkResponse($response, (array) $reports);
    }

    public function handleCreateCriminals(Request $request, Response $response, array $uri_args)
    {
        $criminal = $request->getParsedBody();
        if (isset($criminal[0]))
            throw new HttpBadRequestException($request, 'Bad format provided');

        $rules = [
            'first_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'last_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'age' => ['optional', 'integer'],
            'descent' => ['optional', 'alpha', ['length', 1]],
            'sex' => ['optional', ['length', 1], ['in', ['M', 'F', 'X']]],
            'is_arrested' => ['optional', 'integer', ['regex', '/[0-1]/']]
        ];

        $validated = $this->validateData((array) $criminal, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        $this->criminals_model->createCriminal($criminal);

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];

        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateCriminals(Request $request, Response $response, array $uri_args)
    {
        $id = $uri_args['criminal_id'];
        $criminal = $request->getParsedBody();
        if (isset($criminal[0]))
            throw new HttpBadRequestException($request, 'Bad format provided');

        $rules = [
            'first_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'last_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'age' => ['optional', 'integer'],
            'descent' => ['optional', 'alpha', ['length', 1]],
            'sex' => ['optional', ['in', ['M', 'F', 'X']]],
            'is_arrested' => ['optional', 'integer', ['regex', '/[0-1]/']]
        ];

        $validated = $this->validateData((array) $criminal, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        $success = $this->criminals_model->updateCriminal($criminal, $id);
        if (!$success) {
            throw new HttpBadRequestException($request, 'Update Failed');
        }

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Updated Successfully"
        ];

        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleDeleteCriminals(Request $request, Response $response, array $uri_args)
    {
        $criminal = $uri_args['criminal_id'];
        $success = $this->criminals_model->deleteCriminal($criminal);

        if (!$success) {
            throw new HttpBadRequestException($request, 'Delete Failed');
        }

        $response_data = [
            "code" => HttpCodes::STATUS_OK,
            "message" => "Deleted Successfully"
        ];

        return $this->prepareOkResponse($response, $response_data);
    }
}
