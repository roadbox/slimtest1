<?php
session_start();

ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include autoload
require __DIR__ . '/../vendor/autoload.php';

// Get Slim app settings
$settings = require __DIR__ . '/../src/settings.php';

// Instantiate the app
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
$routes = scandir(__DIR__ . '/../src/routes/');

foreach ($routes as $route) {
    if (strpos($route, '.php')) {
        require __DIR__ . '/../src/routes/' . $route;
    }
}

// Run app
$app->run();