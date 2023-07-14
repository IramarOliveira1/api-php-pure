<?php

use App\Controllers\CategoryController;
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

$router->get('/produto', [ProductController::class, 'all']);
$router->post('/produto', [ProductController::class, 'store']);
$router->delete('/produto/:id', [ProductController::class, 'delete']);
$router->get('/produto/:id', [ProductController::class, 'index']);
$router->put('/produto/:id', [ProductController::class, 'update']);


$router->get('/categoria', [CategoryController::class, 'all']);
$router->post('/categoria', [CategoryController::class, 'store']);
$router->delete('/categoria/:id', [CategoryController::class, 'delete']);
$router->get('/categoria/:id', [CategoryController::class, 'index']);
$router->put('/categoria/:id', [CategoryController::class, 'update']);


$router->run();
