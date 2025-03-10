<?php

global $app;

use Tracy\Debugger;

date_default_timezone_set(env('TIMEZONE', 'UTC'));
error_reporting(env('ERROR_REPORTING', E_ALL));
mb_internal_encoding(env('ENCODING', 'UTF-8'));
setlocale(LC_ALL, 'en_US.UTF-8');

// This autoloads your code in the app directory so you don't have to require_once everything
$app->path(ROOT_DIR);

$config = [
    'flight.views.path' => ROOT_DIR . 'views',
    'flight.views.extension' => '.php',
    'flight.content_length' => true,
    'flight.base_url' => '/',
    'flight.log_errors' => true,
    'flight.handle_errors' => false,
    'flight.app_url' => env('APP_URL'),
];

$app->set($config);

Debugger::enable(mode: !env('APP_DEBUG', false));
//Debugger::enable(Debugger::Development); // sometimes you have to be explicit (also Debugger::PRODUCTION)
Debugger::$logDirectory = STORAGE_DIR . 'logs';
#Debugger::$strictMode = true; // display all errors
Debugger::$strictMode = E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED; // all errors except deprecated notices
if (Debugger::$showBar && php_sapi_name() !== 'cli') {
    $app->set('flight.content_length', false); // if Debugger bar is visible, then content-length can not be set by Flight
}

return [
    'database' => [
        'host' => env('DB_HOST'),
        'database' => env('DB_DATABASE'),
        'user' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),

        // uncomment the following line for sqlite
        // 'file_path' => __DIR__ . DS . '..' . DS . env('DB_DATABASE')
    ],
];