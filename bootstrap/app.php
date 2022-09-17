<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Http\Middleware\CORSFix;
use App\Http\Middleware\TrustProxies;

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades();
$app->withEloquent();

$app->register(Irazasyed\Larasupport\Providers\ArtisanServiceProvider::class);

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);

$app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);
$app->register(Hhxsv5\LaravelS\Illuminate\LaravelSServiceProvider::class);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->configure('app');
$app->configure('laravels');
$app->configure('trustedproxy');

$app->middleware([
    TrustProxies::class,
    CORSFix::class
]);

$app->router->group([
    'namespace'  => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/api.php';
});

return $app;
