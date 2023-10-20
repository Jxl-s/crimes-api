<?php

namespace Vanier\Api\Middleware;

use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Vanier\Api\Exceptions\HttpNotAcceptableException;

/**
 * Handles content negotiation for the application.
 * The API will only support application/json for now
 */
class ContentNegotiationMiddleware implements MiddlewareInterface
{
    /**
     * Returns an error if the given resource representation is unsupported
     *
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface
     */
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        // Give it an empty value in case the header is not present; it makes it easier for comparing
        $accept_header = $request->getHeader('Accept')[0] ?? '';

        // Use switch, in case any future resource representations will be supported
        switch ($accept_header) {
            case 'application/json':
                // application/json is the only accepted representation for now
                break;
            default:
                // With custom exception:
                // throw new HttpNotAcceptableException($request, "The requested representation '$accept_header' in the 'Accept' header is not supported. Only 'application/json' is supported.");

                // With a response object:
                $response = new Response();
                $response->getBody()->write(json_encode([
                    'code' => StatusCodeInterface::STATUS_NOT_ACCEPTABLE,
                    'message' => 'Unsupported resource representation',
                    'description' => "The requested representation '$accept_header' in the 'Accept' header is not supported. Only 'application/json' is supported."
                ]));

                return $response->withStatus(StatusCodeInterface::STATUS_NOT_ACCEPTABLE)->withAddedHeader(HEADERS_CONTENT_TYPE, APP_MEDIA_TYPE_JSON);
        }

        // DO NOT remove the following statements. 
        $response = $handler->handle($request);
        return $response;
    }
}
