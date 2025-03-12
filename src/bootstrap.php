<?php

require ROOT_DIR . 'vendor' . DS . 'autoload.php';

if (! file_exists(SRC_DIR . 'config.php')) {
    Flight::halt(500, 'Config file not found. Please create a config.php file in the app/config directory to get started.');
}

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_DIR);
$dotenv->load();

require 'helpers.php';

$app = Flight::app();
$router = $app->router();

$config = require 'config.php';
require 'middleware.php';
require 'routes.php';
require 'services.php';

$app->start();
