<?php

use Dotenv\Dotenv;

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

// Load Environment
$dotEnv = Dotenv::createImmutable("./../src/app/config/");
$dotEnv->safeLoad();

date_default_timezone_set($_ENV["APP_TIMEZONE"]);

// Instantiate the app
$settings = require __DIR__ . './../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . './../src/dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . './../src/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . './../src/routes.php';
$routes($app);

// API Routes
$routesApi = glob(__DIR__.'./../src/app/routes/api/*/routes.php');
foreach ($routesApi as $routeApi)
{
    $newRouteApi = require $routeApi;
    $newRouteApi($app);
}

// API Scheduler
$routesScheduler = glob(__DIR__.'./../src/app/routes/scheduler/*/routes.php');
foreach ($routesScheduler as $routeScheduler)
{
    $newRouteScheduler = require $routeScheduler;
    $newRouteScheduler($app);
}

// Run app
$app->run();
