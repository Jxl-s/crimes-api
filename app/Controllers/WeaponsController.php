<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class WeaponsController extends BaseController
{
    public function handleGetWeapons(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleGetWeaponById(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }
    
    public function handleCreateWeapons(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleUpdateWeapons(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeleteWeapons(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }
}