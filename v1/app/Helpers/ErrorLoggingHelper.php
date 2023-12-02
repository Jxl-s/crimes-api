<?php

namespace Vanier\Api\Helpers;
use Fig\Http\Message\StatusCodeInterface;
use Monolog\Logger;
use Monolog\Level;
use Monolog\Handler\StreamHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;


class ErrorLoggingHelper
{
    public function __construct()
    {
    }

    /**
     * Log error to error.log file in detail
     *  user's action
     *  status code
     * 
     * @param ServerRequestInterface $request
     * @param Response $response
     */
    public function process(ServerRequestInterface $request, Response $response) {
        $error = new Logger("error_logs");
        $error->setTimezone(new \DateTimeZone("America/Toronto"));
        $error->pushHandler(new StreamHandler(APP_LOG_DIR . 'error.log', Level::Error));
        $error->error('Error ' . " " .  $_SERVER['REMOTE_ADDR'] . " " . $request->getUri()->getPath() . " " . $request->getUri()->getQuery() . " " . $response->getStatusCode() . " " . $response->getBody());
    }
}
