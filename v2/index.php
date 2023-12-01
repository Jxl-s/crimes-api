<?php
/**
 * Thang Manh Tran
 * Vinh Quang Mai
 * Jia Xuan Li 
 */
use Slim\Factory\AppFactory;
use Vanier\Api\Helpers\ErrorLoggingHelper;
use Vanier\Api\Middleware\ContentNegotiationMiddleware;
use Dotenv\Dotenv;
use Vanier\Api\Middleware\JWTAuthMiddleware;
use Vanier\Api\Middleware\AppLoggingMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Vanier\Api\Helpers;

error_reporting(E_ALL ^ E_DEPRECATED);

define('APP_BASE_DIR',  __DIR__);
define('APP_LOG_DIR', APP_BASE_DIR."/logs/");
define('APP_ENV_FILE', 'config.env');
define('APP_JWT_TOKEN_KEY', 'APP_JWT_TOKEN');

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ .'/app/Config/app_config.php';

$dotenv = Dotenv::createImmutable(__DIR__, 'config.env');
$dotenv->load();

// Step 1) Instantiate a Slim app.
$app = AppFactory::create();

// Logging middleware

$app->addMiddleware(new AppLoggingMiddleware());

// Define Custom Error Handler
$customErrorHandler = function (
    ServerRequestInterface $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails,
    ?LoggerInterface $logger = null
) use ($app) {
    if ($logger) {
        $logger->error($exception->getMessage());
    }

    $payload = ['error' => $exception->getMessage(). ' '.$request->getUri()->getPath()];
    // TODO Make a helper class that logs errors
    $response = $app->getResponseFactory()->createResponse($exception->getCode());
    $response->getBody()->write(
        json_encode($payload, JSON_UNESCAPED_UNICODE)
    );
    $response->withStatus($exception->getCode())->withAddedHeader(HEADERS_CONTENT_TYPE, APP_MEDIA_TYPE_JSON);
    $error = new ErrorLoggingHelper();
    $error->process($request, $response);
    return $response;
};

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

// JWT middleware
$app->addMiddleware(new JWTAuthMiddleware());

$app->addMiddleware(new ContentNegotiationMiddleware());


// Add the routing and body parsing middleware.
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();


// NOTE: the error handling middleware MUST be added last.
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->getDefaultErrorHandler()->forceContentType(APP_MEDIA_TYPE_JSON);

$app->setBasePath("/crimes-api/v2");

// Here we include the file that contains the application routes. 
// NOTE: your routes must be managed in the api_routes.php file.
require_once __DIR__ . '/app/Routes/app_routes.php';

// Run the app.
$app->run();
