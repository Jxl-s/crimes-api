<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ModiController extends BaseController
{
    public function handleGetModi(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleGetModiById(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }
    
    public function handleCreateModi(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleUpdateModi(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeleteModi(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }
}