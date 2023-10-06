<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Vanier\Api\Models\BaseModel;

class BaseController
{
    protected function prepareOkResponse(Response $response, array $data, int $status_code = 200)
    {
        // var_dump($data);
        $json_data = json_encode($data);
        //-- Write JSON data into the response's body.        
        $response->getBody()->write($json_data);
        return $response->withStatus($status_code)->withAddedHeader(HEADERS_CONTENT_TYPE, APP_MEDIA_TYPE_JSON);
    }

    /**
     * Gets the query parameters, and sets pagination options
     * if necessary
     *
     * @param BaseModel $model
     * @param Request $request
     * @return array
     */
    protected function getFilters(Request $request, BaseModel $model, array $sort_fields)
    {
        $filters = $request->getQueryParams();

        // Get the fields to use
        $page = $filters['page'] ?? 1;
        $page_size = $filters['page_size'] ?? 10;

        // Get the fields to use
        $sort_by = $filters['sort_by'] ?? $sort_fields[0];
        $order = strtolower($filters['order'] ?? 'asc');

        // TODO: Validate pagination fields

        // Validate ordering fields
        if (!in_array($sort_by, $sort_fields)) {
            throw new HttpBadRequestException($request, 'sort_by is invalid. Valid values: ' . implode(', ', $sort_fields));
        }

        if ($order !== 'asc' && $order !== 'desc') {
            throw new HttpBadRequestException($request, 'order is invalid. Value values: asc, desc');
        }

        $model->setPaginationOptions($page, $page_size);
        $model->setSortingOptions($sort_by, $order);

        return $filters;
    }
}
