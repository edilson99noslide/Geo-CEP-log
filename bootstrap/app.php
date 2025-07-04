<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(dirname(__DIR__)))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

$app = new Laravel\Lumen\Application(dirname(__DIR__));

$app->configure('cors');

// Facades e Http Client
$app->withFacades();

// Exceptions e Console
$app->singleton(Illuminate\Contracts\Debug\ExceptionHandler::class, App\Exceptions\Handler::class);
$app->singleton(Illuminate\Contracts\Console\Kernel::class, App\Console\Kernel::class);

// Configs (se tiver)
$app->configure('app');

// Middleware - registre o seu CORS aqui se quiser
$app->middleware([
    App\Http\Middleware\CorsMiddleware::class,
]);

// Rotas
$app->router->group(['namespace' => 'App\Http\Controllers'], function ($router) {
    require __DIR__.'/../routes/web.php';
});

if ($app->runningInConsole()) {
    $app->register(Laravel\Lumen\Console\ConsoleServiceProvider::class);
}

return $app;
