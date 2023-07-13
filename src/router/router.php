<?php

use App\Controllers\ProductController;
use Buki\Router\Router;

$router = new Router([
    'paths' => [
        'controllers' => '..\src\app\Controllers',
    ],
    'namespaces' => [
        'controllers' => 'App\Controllers',
    ],
    'debug' => true,
]);

$router->get('/', [ProductController::class, 'all']);
$router->post('/', [ProductController::class, 'store']);
$router->delete('/:id', [ProductController::class, 'delete']);
// $router->get('/:id', [ProductController::class, 'index']);
// $router->update('/', [ProductController::class, 'all']);


$router->run();
