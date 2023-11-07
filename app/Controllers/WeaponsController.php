<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\WeaponsModel;

class WeaponsController extends BaseController
{
    private $weapons_model;

    public function __construct()
    {
        $this->weapons_model = new WeaponsModel();
    }

    public function handleGetWeapons(Request $request, Response $response, array $uri_args)
    {
        $filters = $this->getFilters($request, $this->weapons_model, ['weapon_id', 'type', 'material', 'color', 'description']);

        $rules = [
            'type' => ['optional', 'ascii', ['lengthMax', 50]],
            'material' => ['optional', 'ascii', ['lengthMax', 50]],
            'color' => ['optional', 'ascii', ['lengthMax', 50]],
            'description' => ['optional', 'ascii', ['lengthMax', 50]]
        ];

        $validated = $this->validateData($filters, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        $weapons = $this->weapons_model->getAllWeapons($filters);

        return $this->prepareOkResponse($response, (array) $weapons);
    }

    public function handleGetWeaponById(Request $request, Response $response, array $uri_args)
    {
        // Get the ID
        $id = $uri_args['weapon_id'];
        if (!Input::isInt($id, 0))
            throw new HttpBadRequestException($request, "Invalid Code");

        // Find the weapon
        $weapon = $this->weapons_model->getWeaponById($id);
        if (!$weapon)
            throw new HttpNotFoundException($request, 'Weapon Not Found');

        // Send the response
        return $this->prepareOkResponse($response, (array) $weapon);
    }

    public function handleGetWeaponReports(Request $request, Response $response, array $uri_args)
    {
        $weapon_id = $uri_args['weapon_id'];
        $filters = $this->getFilters($request, $this->weapons_model, ['report_id', 'last_update', 'fatalities', 'premise',]);
        if (!Input::isInt($weapon_id, 0))
            throw new HttpBadRequestException($request, "Invalid Weapon Id");

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

        $reports = $this->weapons_model->getWeaponReports($weapon_id, $filters);

        return $this->prepareOkResponse($response, (array) $reports);
    }

    public function handleCreateWeapons(Request $request, Response $response, array $uri_args)
    {
        $weapon = $request->getParsedBody();
        if (isset($weapon[0]))
            throw new HttpBadRequestException($request, 'Bad format provided.');

        $rules = [
            'type' => ['required', 'ascii', ['lengthMax', 50]],
            'material' => ['required', 'ascii', ['lengthMax', 50]],
            'color' => ['required', 'ascii', ['lengthMax', 50]],
            'description' => ['required', 'ascii', ['lengthMax', 50]]
        ];

        $validated = $this->validateData((array) $weapon, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        $this->weapons_model->createWeapon($weapon);

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateWeapons(Request $request, Response $response, array $uri_args)
    {
        $id = $uri_args['weapon_id'];
        $weapon = $request->getParsedBody();
        if (isset($weapon[0]))
            throw new HttpBadRequestException($request, 'Bad format provided.');

        $rules = [
            'type' => ['required', 'ascii', ['lengthMax', 50]],
            'material' => ['required', 'ascii', ['lengthMax', 50]],
            'color' => ['required', 'ascii', ['lengthMax', 50]],
            'description' => ['required', 'ascii', ['lengthMax', 50]]
        ];

        $validated = $this->validateData((array) $weapon, $rules);
        if ($validated !== true) {
            throw new HttpBadRequestException($request, $validated);
        }

        $this->weapons_model->updateWeapon($weapon, $id);

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Updated Successfully"
        ];

        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleDeleteWeapons(Request $request, Response $response, array $uri_args)
    {
        $weapon_id = $uri_args['weapon_id'];
        $weapon = $this->weapons_model->getWeaponById($weapon_id);
        
        if (!$weapon) {
            throw new HttpNotFoundException($request, 'Weapon not found');
        }

        $success = $this->weapons_model->deleteWeapon($weapon_id);
        if (!$success) {
            throw new HttpBadRequestException($request, 'Failed to delete weapon');
        }

        $response_data = [
            "code" => HttpCodes::STATUS_OK,
            "message" => "Deleted Successfully"
        ];

        return $this->prepareOkResponse($response, $response_data);
    }
}
