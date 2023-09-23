<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class VictimsController extends BaseController
{
    public function handleGetVictims(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleCreateVictims(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleUpdateVictims(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeleteVictims(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }
}