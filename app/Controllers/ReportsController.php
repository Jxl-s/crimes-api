<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ReportsController extends BaseController
{
    public function handleGetReports(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleGetReportById(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }
    
    public function handleCreateReports(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleUpdateReports(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }

    public function handleDeleteReports(Request $request, Response $response, array $uri_args)
    {
        return $response;
    }
}