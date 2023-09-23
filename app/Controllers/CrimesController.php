<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CrimesController extends BaseController
{
    public function handleGetCrimes(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }


    public function handleCreateCrimes(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleUpdateCrimes(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeleteCrimes(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }
}