<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\CrimesController;
use Vanier\Api\Controllers\CriminalsController;
use Vanier\Api\Controllers\DistrictsController;
use Vanier\Api\Controllers\ModiController;
use Vanier\Api\Controllers\PoliceController;
use Vanier\Api\Controllers\ReportsController;
use Vanier\Api\Controllers\VictimsController;
use Vanier\Api\Controllers\WeaponsController;
use Vanier\Api\Controllers\AccountsController;

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
$app->get('/crimes/{crime_code}', [CrimesController::class, 'handleGetCrimeByCode']);

$app->post('/crimes', [CrimesController::class, 'handleCreateCrimes']);
$app->delete('/crimes/{crime_code}', [CrimesController::class, 'handleDeleteCrimes']);
$app->put('/crimes/{crime_code}', [CrimesController::class, 'handleUpdateCrimes']);

//criminals
$app->get('/criminals', [CriminalsController::class, 'handleGetCriminals']);
$app->get('/criminals/{criminal_id}', [CriminalsController::class, 'handleGetCriminalById']);
$app->get('/criminals/{criminal_id}/reports', [CriminalsController::class, 'handleGetCriminalReports']);
$app->get('/criminals/fbi/wanted', [CriminalsController::class, 'handleGetWantedCriminals']);

$app->post('/criminals', [CriminalsController::class, 'handleCreateCriminals']);
$app->delete('/criminals/{criminal_id}', [CriminalsController::class, 'handleDeleteCriminals']);
$app->put('/criminals/{criminal_id}', [CriminalsController::class, 'handleUpdateCriminals']);

//districts
$app->get('/districts', [DistrictsController::class, 'handleGetDistricts']);
$app->get('/districts/{district_id}', [DistrictsController::class, 'handleGetDistrictById']);
$app->get('/districts/{district_id}/reports', [DistrictsController::class, 'handleGetDistrictReports']);
$app->get('/districts/{district_id}/police', [DistrictsController::class, 'handleGetDistrictPolice']);

$app->post('/districts', [DistrictsController::class, 'handleCreateDistricts']);
$app->delete('/districts/{district_id}', [DistrictsController::class, 'handleDeleteDistricts']);
$app->put('/districts/{district_id}', [DistrictsController::class, 'handleUpdateDistricts']);

//modi
$app->get('/modi', [ModiController::class, 'handleGetModi']);
$app->get('/modi/{mo_code}', [ModiController::class, 'handleGetModiByCode']);

$app->post('/modi', [ModiController::class, 'handleCreateModi']);
$app->delete('/modi/{mo_code}', [ModiController::class, 'handleDeleteModi']);
$app->put('/modi/{mo_code}', [ModiController::class, 'handleUpdateModi']);

//Police
$app->get('/police', [PoliceController::class, 'handleGetPolice']);
$app->get('/police/{badge_id}', [PoliceController::class, 'handleGetPoliceById']);
$app->get('/police/{badge_id}/reports', [PoliceController::class, 'handleGetPoliceReports']);

$app->post('/police', [PoliceController::class, 'handleCreatePolice']);
$app->delete('/police/{badge_id}', [PoliceController::class, 'handleDeletePolice']);
$app->put('/police/{badge_id}', [PoliceController::class, 'handleUpdatePolice']);

//reports
$app->get('/reports', [ReportsController::class, 'handleGetReports']);
$app->get('/reports/{report_id}', [ReportsController::class, 'handleGetReportById']);
$app->get('/reports/{report_id}/victims', [ReportsController::class, 'handleGetReportVictims']);
$app->get('/reports/{report_id}/criminals', [ReportsController::class, 'handleGetReportCriminals']);
$app->get('/reports/{report_id}/police', [ReportsController::class, 'handleGetReportPolice']);
$app->get('/reports/{report_id}/crimes', [ReportsController::class, 'handleGetReportCrimes']);
$app->get('/reports/{report_id}/modi', [ReportsController::class, 'handleGetReportModus']);
$app->get('/reports/{report_id}/weather', [ReportsController::class, 'handleGetReportWeather']);
$app->get('/reports/{report_id}/distance', [ReportsController::class, 'handleGetReportDistance']);

$app->post('/reports', [ReportsController::class, 'handleCreateReports']);
$app->delete('/reports/{report_id}', [ReportsController::class, 'handleDeleteReports']);
$app->put('/reports/{report_id}', [ReportsController::class, 'handleUpdateReports']);

//victims
$app->get('/victims', [VictimsController::class, 'handleGetVictims']);
$app->get('/victims/{victim_id}', [VictimsController::class, 'handleGetVictimById']);

$app->post('/victims', [VictimsController::class, 'handleCreateVictims']);
$app->delete('/victims/{victim_id}', [VictimsController::class, 'handleDeleteVictims']);
$app->put('/victims/{victim_id}', [VictimsController::class, 'handleUpdateVictims']);

//weapons
$app->get('/weapons', [WeaponsController::class, 'handleGetWeapons']);
$app->get('/weapons/{weapon_id}', [WeaponsController::class, 'handleGetWeaponById']);
$app->get('/weapons/{weapon_id}/reports', [WeaponsController::class, 'handleGetWeaponReports']);

$app->post('/weapons', [WeaponsController::class, 'handleCreateWeapons']);
$app->delete('/weapons/{weapon_id}', [WeaponsController::class, 'handleDeleteWeapons']);
$app->put('/weapons/{weapon_id}', [WeaponsController::class, 'handleUpdateWeapons']);

//token 
$app->post('/token', [AccountsController::class, 'handleGenerateToken']);

//account 
$app->post('/account', [AccountsController::class, 'handleCreateAccount']);
