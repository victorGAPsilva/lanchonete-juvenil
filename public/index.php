<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

$router = new \App\Core\Router();
$routes = require APP_ROOT . '/config/routes.php';
$routes($router);
$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $_SERVER['REQUEST_URI'] ?? '/');
