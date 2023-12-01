<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\CriminalsModel;
use GuzzleHttp\Client as GuzzleClient;

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

        if (isset($filters['is_arrested']) && $filters['is_arrested'] == null) {
            throw new HttpBadRequestException($request, "Please make sure no integer is empty");
        }

        $rules = [
            'first_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'last_name' => ['optional', 'ascii', ['lengthMax', 50]],
            'age' => ['optional', 'integer'],
            'sex' => ['optional', ['length', 1], ['in', ['M', 'F', 'X']]],
            'height' => ['optional', 'integer', ['min', 1]],
            'descent' => ['optional', 'alpha', ['length', 1]],
            'is_arrested' => ['optional', 'integer', ['regex', '/^[0-1]$/']]
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

        // Find all cases the given criminal involved in
        $reports = $this->criminals_model->getCriminalReports($id, $filters);

        // Send the response
        return $this->prepareOkResponse($response, (array) $reports);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Response $response
     * @param array $uri_args
     * @return void
     */
    public function handleGetWantedCriminals(Request $request, Response $response, array $uri_args) {
        $filters = $request->getQueryParams();
        $rules = [
            'pageSize' => [
                'required',
                ['min' , 1],
                'integer'
            ],
            'page' => [
                'required',
                ['min' , 1],
                'integer'
            ],
            'sort_on' => [
                ['in' , ['publication', 'modified']]
            ],
            'sort_order' => [
                ['in' , ['asc', 'desc']]
            ],
            'person_classification' => [
                ['in' , ['Main', 'Victim', 'Accomplice']]
            ],
            'poster_classification' => [
                ['in' , ['default', 'ten', 'terrorist', 'information', 'kidnapping', 'missing', 'most', 'crimes-against-children', 'ecap', 'law-enforcement-assistance']]
            ]
        ];
        $validated = $this->validateData($filters, $rules);
        if($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }   
        $client = new GuzzleClient(['base_uri' => 'https://api.fbi.gov']);
        $data = json_decode($client->request('GET', '/@wanted', [
            'query' => $filters,     
            'headers' => [
                'User-Agent' => $_SERVER['HTTP_USER_AGENT'],
        ]])->getBody(), true);
        return $this->prepareOkResponse($response, (array) $data);
    }   

    public function handleCreateCriminals(Request $request, Response $response, array $uri_args)
    {
        $criminal = $request->getParsedBody();
        if (isset($criminal[0]))
            throw new HttpBadRequestException($request, 'Bad format provided');
        if ($criminal === null) {
            throw new HttpBadRequestException($request, 'Bad format provided. Please make sure no integer starts with 0');
        }

        $rules = [
            'first_name' => ['required', 'ascii', ['lengthMax', 50]],
            'last_name' => ['required', 'ascii', ['lengthMax', 50]],
            'age' => ['required', 'integer'],
            'sex' => ['required', ['length', 1], ['in', ['M', 'F', 'X']]],
            'height' => ['required', 'integer', ['min', 1]],
            'descent' => ['required', 'alpha', ['length', 1]],
            'is_arrested' => ['required', 'integer', ['regex', '/^[0-1]$/']]
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
        $criminal_id = $uri_args['criminal_id'];
        $criminal = $this->criminals_model->getCriminalById($criminal_id);

        if(!$criminal)
            throw new HttpNotFoundException($request, "Criminal not found");

        $criminal = $request->getParsedBody();
        if (isset($criminal[0]))
            throw new HttpBadRequestException($request, 'Bad format provided');
        if ($criminal === null) {
            throw new HttpBadRequestException($request, 'Bad format provided. Please make sure no integer starts with 0');
        }

        $rules = [
            'first_name' => ['required', 'ascii', ['lengthMax', 50]],
            'last_name' => ['required', 'ascii', ['lengthMax', 50]],
            'age' => ['required', 'integer'],
            'sex' => ['required', ['length', 1], ['in', ['M', 'F', 'X']]],
            'height' => ['required', 'integer', ['min', 1]],
            'descent' => ['required', 'alpha', ['length', 1]],
            'is_arrested' => ['required', 'integer', ['regex', '/^[0-1]$/']]
        ];

        $validated = $this->validateData((array) $criminal, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        $success = $this->criminals_model->updateCriminal($criminal, $criminal_id);
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
        $criminal_id = $uri_args['criminal_id'];
        $criminal = $this->criminals_model->getCriminalById($criminal_id);

        if(!$criminal)
            throw new HttpNotFoundException($request, "Criminal not found");

        $success = $this->criminals_model->deleteCriminal($criminal_id);

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
