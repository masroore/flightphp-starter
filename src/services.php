<?php

use eftec\bladeone\BladeOne;
use flight\Engine;

// use flight\debug\database\PdoQueryCapture;

/**
 * @var array $config
 * @var Engine $app
 */

// uncomment the following line for MySQL
// $dsn = 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['dbname'] . ';charset=utf8mb4';

if (env_development()) {
    // In development, you'll want the class that captures the queries for you. In production, not so much.
    // $pdoClass = Debugger::$showBar === true ? PdoQueryCapture::class : PdoWrapper::class;
    // $app->register('db', $pdoClass, [$dsn, $config['database']['user'] ?? null, $config['database']['password'] ?? null]);
}

// Configure Blade
Flight::register('view', BladeOne::class, [], static function (BladeOne $blade): void {
    $views = RESOURCES_DIR . 'views';
    $cache = STORAGE_DIR . 'cache';

    $blade->setMode(env_development() ? BladeOne::MODE_DEBUG : BladeOne::MODE_FAST);
    $blade->setPath($views, $cache);
});

Flight::map('render', static function (string $template, array $data = []): void {
    echo Flight::view()->run($template, $data);
});

/*
// Overwrite the render method to use Latte.
$app->map('render', function (string $templatePath, array $data = [], ?string $block = null) use ($app, $Latte) {
    $templatePath = __DIR__ . '/../views/' . $templatePath;
    // Add the username that's available in every template.
    $data = [
        'username' => $app->session()->getOrDefault('user', '')
    ] + $data;
    $Latte->render($templatePath, $data, $block);
});

// Register Session
$app->register('session', \Ghostff\Session\Session::class);

// Permissions
$currentRole = $app->session()->getOrDefault('role', 'guest');
$app->register('permission', \flight\Permission::class, [$currentRole]);
$permission = $app->permission();
$permission->defineRule('post', function (string $currentRole) {
    if ($currentRole === 'admin') {
        $permissions = ['create', 'read', 'update', 'delete'];
    } else if ($currentRole === 'editor') {
        $permissions = ['create', 'read', 'update'];
    } else {
        $permissions = ['read'];
    }
    return $permissions;
});
$permission->defineRule('comment', function (string $currentRole) {
    if ($currentRole === 'admin') {
        $permissions = ['create', 'read', 'update', 'delete'];
    } else if ($currentRole === 'editor') {
        $permissions = ['create', 'read', 'update'];
    } else {
        $permissions = ['read'];
    }
    return $permissions;
});
*/
