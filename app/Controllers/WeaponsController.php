<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\WeaponsModel;

class WeaponsController extends BaseController
{
    private $weapons_model;

    public function __construct() {
        $this->weapons_model = new WeaponsModel();
    }

    public function handleGetWeapons(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();

        $page = $filters['page'] ?? 1;
        $page_size = $filters['page_size'] ?? 10;

        $this->weapons_model->setPaginationOptions($page, $page_size);
        $weapons = $this->weapons_model->getAllWeapons($filters);

        return $this->prepareOkResponse($response, (array) $weapons);
    }

    public function handleGetWeaponById(Request $request, Response $response, array $uri_args)
    {
        // Throwing an exception
        $id = $uri_args['weapon_id'];
        if (!Input::isInt($id))
            throw new HttpNotFoundException($request, "Invalid Code");
        
        $weapon = $this->weapons_model->getWeaponById($id);
        //step 3) send the response
        return $this->prepareOkResponse($response, (array) $weapon);
    }
    
    public function handleCreateWeapons(Request $request, Response $response, array $uri_args)
    {
        $weapons = $request->getParsedBody();
        
        //TODO: Validate contents

        foreach ($weapons as $id => $weapon) {
            $this->weapons_model->createWeapon($weapon);
        }

        $response_data = [
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Inserted Successfully"
        ];
        return $this->prepareOkResponse($response, $response_data);
    }

    public function handleUpdateWeapons(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeleteWeapons(Request $request, Response $response, array $uri_args)
    {
        $weapon = $request->getParsedBody();
		$this->weapons_model->deleteWeapon($weapon);

		return $this->prepareOkResponse($response, (array) $weapon);
    }
}