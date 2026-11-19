<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

// .env no se versiona: si no existe, se usan los valores por defecto.
Dotenv::createImmutable(__DIR__ . '/..')->safeLoad();

date_default_timezone_set($_ENV['APP_TIMEZONE'] ?? 'America/Bogota');

require __DIR__ . '/../app/global/database_config.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);

$cors = require __DIR__ . '/../app/Middlewares/cors.php';
$cors($app);

$endpoints = require __DIR__ . '/../app/Presentation/Routers/endpoints.php';
$endpoints($app);

// Endpoint de salud: no toca la base de datos.
$app->get('/health', function (Request $request, Response $response) {
    $payload = json_encode([
        'status' => 'ok',
        'service' => 'ms-vehiculos',
        'time' => date('c'),
    ], JSON_UNESCAPED_UNICODE);

    $response->getBody()->write($payload);

    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();