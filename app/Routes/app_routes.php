<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\CrimesController;
use Vanier\Api\Controllers\CriminalsController;
use Vanier\Api\Controllers\DistrictsController;
use Vanier\Api\Controllers\ModiController;
use Vanier\Api\Controllers\PoliceController;
use Vanier\Api\Controllers\ReportsController;
use Vanier\Api\Controllers\VictimsController;
use Vanier\Api\Controllers\WeaponsController;

// Import the app instance into this file's scope.
global $app;

// NOTE: Add your app routes here.
// The callbacks must be implemented in a controller class.
// The Vanier\Api must be used as namespace prefix. 

// ROUTE: GET /
$app->get('/', [AboutController::class, 'handleAboutApi']); 

// ROUTE: GET /hello
$app->get('/hello', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Reporting! Hello there!");            
    return $response;
});

//crimes
$app->get('/crimes', [CrimesController::class, 'handleGetCrimes']);
$app->post('/crimes', [CrimesController::class, 'handleCreateCrimes']);
$app->delete('/crimes', [CrimesController::class, 'handleDeleteCrimes']);
$app->put('/crimes', [CrimesController::class, 'handleUpdateCrimes']);

//criminals
$app->get('/criminals', [CriminalsController::class, 'handleGetCriminals']);
$app->post('/criminals', [CriminalsController::class, 'handleCreateCriminals']);
$app->delete('/criminals', [CriminalsController::class, 'handleDeleteCriminals']);
$app->put('/criminals', [CriminalsController::class, 'handleUpdateCriminals']);

//Districts
$app->get('/districts', [DistrictsController::class, 'handleGetDistricts']);
$app->post('/districts', [DistrictsController::class, 'handleCreateDistricts']);
$app->delete('/districts', [DistrictsController::class, 'handleDeleteDistricts']);
$app->put('/districts', [DistrictsController::class, 'handleUpdateDistricts']);

//Districts
$app->get('/modi', [ModiController::class, 'handleGetModi']);
$app->post('/modi', [ModiController::class, 'handleCreateModi']);
$app->delete('/modi', [ModiController::class, 'handleDeleteModi']);
$app->put('/modi', [ModiController::class, 'handleUpdateModi']);

//Police
$app->get('/police', [PoliceController::class, 'handleGetPolice']);
$app->post('/police', [PoliceController::class, 'handleCreatePolice']);
$app->delete('/police', [PoliceController::class, 'handleDeletePolice']);
$app->put('/police', [PoliceController::class, 'handleUpdatePolice']);

//reports
$app->get('/reports', [ReportsController::class, 'handleGetReports']);
$app->post('/reports', [ReportsController::class, 'handleCreateReports']);
$app->delete('/reports', [ReportsController::class, 'handleDeleteReports']);
$app->put('/reports', [ReportsController::class, 'handleUpdateReports']);

//victims
$app->get('/victims', [VictimsController::class, 'handleGetVictims']);
$app->post('/victims', [VictimsController::class, 'handleCreateVictims']);
$app->delete('/victims', [VictimsController::class, 'handleDeleteVictims']);
$app->put('/victims', [VictimsController::class, 'handleUpdateVictims']);

//weapons
$app->get('/weapons', [WeaponsController::class, 'handleGetWeapons']);
$app->post('/weapons', [WeaponsController::class, 'handleCreateWeapons']);
$app->delete('/weapons', [WeaponsController::class, 'handleDeleteWeapons']);
$app->put('/weapons', [WeaponsController::class, 'handleUpdateWeapons']);