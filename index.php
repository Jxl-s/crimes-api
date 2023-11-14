<?php
use Slim\Factory\AppFactory;
use Vanier\Api\Middleware\ContentNegotiationMiddleware;
use Dotenv\Dotenv;
use Vanier\Api\Middleware\JWTAuthMiddleware;

error_reporting(E_ALL ^ E_DEPRECATED);

define('APP_BASE_DIR',  __DIR__);
define('APP_ENV_FILE', 'config.env');
define('APP_JWT_TOKEN_KEY', 'APP_JWT_TOKEN');

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ .'/app/Config/app_config.php';

$dotenv = Dotenv::createImmutable(__DIR__, 'config.env');
$dotenv->load();

// Step 1) Instantiate a Slim app.
$app = AppFactory::create();

// JWT middleware
$app->addMiddleware(new JWTAuthMiddleware());

$app->addMiddleware(new ContentNegotiationMiddleware());


// Add the routing and body parsing middleware.
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();


// NOTE: the error handling middleware MUST be added last.
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->getDefaultErrorHandler()->forceContentType(APP_MEDIA_TYPE_JSON);

$app->setBasePath("/crimes-api");

// Here we include the file that contains the application routes. 
// NOTE: your routes must be managed in the api_routes.php file.
require_once __DIR__ . '/app/Routes/app_routes.php';

// Run the app.
$app->run();
