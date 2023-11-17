<?php

use Fig\Http\Message\StatusCodeInterface;
use Monolog\Logger;
use Monolog\Level;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;

class AppLoggingMiddleware
{
    public function process(Request $request, RequestHandler $handler): ResponseInterface {
        $logger = new Logger("access_logs");
        $logger->setTimezone(new DateTimeZone("America/Toronto"));
        $logger->pushHandler(new StreamHandler(APP_LOG_DIR . 'access.log', Level::Debug));
        $logger->pushHandler(new FirePHPHandler());
        $response = $handler->handle($request);
        return $response;
    }
}
