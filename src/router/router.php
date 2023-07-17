<?php

use App\Controllers\CategoryController;
use App\Controllers\ProductController;
use App\Controllers\UserController;
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
$router->post('/produto/:id', [ProductController::class, 'update']);

$router->get('/categoria', [CategoryController::class, 'all']);
$router->post('/categoria', [CategoryController::class, 'store']);
$router->delete('/categoria/:id', [CategoryController::class, 'delete']);
$router->get('/categoria/:id', [CategoryController::class, 'index']);
$router->put('/categoria/:id', [CategoryController::class, 'update']);

$router->get('/usuario', [UserController::class, 'all']);
$router->post('/usuario', [UserController::class, 'store']);
$router->delete('/usuario/:id', [UserController::class, 'delete']);
$router->get('/usuario/:id', [UserController::class, 'index']);
$router->put('/usuario/:id', [UserController::class, 'update']);

$router->run();
