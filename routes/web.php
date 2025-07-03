<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// Prefixo para /api
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/cel/{cep}', function () {
        return response()->json(['message' => 'Api ativa!']);
    });

    $router->get('/test', function () {
        return response()->json(['message' => 'Api ativa!']);
    });
});

