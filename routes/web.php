<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// Prefixo para /api
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/cep/{cep}', 'CepController@consult');

    $router->get('/test', function () {
        return response()->json(['message' => 'Api ativa!']);
    });
});

