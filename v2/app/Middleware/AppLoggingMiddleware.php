<?php

namespace Vanier\Api\Middleware;

use Fig\Http\Message\StatusCodeInterface;
use Monolog\Logger;
use Monolog\Level;
use Monolog\Handler\StreamHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;

class AppLoggingMiddleware implements MiddlewareInterface
{
    public function process(Request $request, RequestHandler $handler): ResponseInterface {

        $logger = new Logger("access_logs");
        $logger->setTimezone(new \DateTimeZone("America/Toronto"));
        $logger->pushHandler(new StreamHandler(APP_LOG_DIR . 'access.log', Level::Debug));
        $response = $handler->handle($request);
        $logger->info('Log ' . " " .  $_SERVER['REMOTE_ADDR'] . " " . $request->getUri()->getPath() . " " . $request->getUri()->getQuery() . " " . 
            $response->getBody() . " " . $response->getStatusCode());
        return $response;
    }
}
