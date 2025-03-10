<?php

use flight\Engine;
use flight\net\Router;
use Rakit\Validation\Validator;

/** @var Router $router */
/** @var Engine $app */

$router->get('/test', function () use ($app) {
    #$request = $app->request()->data->getData();
    $request = $app->request()->query->getData();
    $validator = (new Validator)->make($request,
        [
            'name' => 'required',
            'num' => 'required|numeric',
        ]
    );
    $validator->validate();
    if ($validator->fails()) {
        echo "<pre>";
        print_r($validator->errors()->firstOfAll());
        echo "</pre>";
        exit;
    }
    $app->render('home', ['title' => 'FlightPhp', 'name' => $request['name'], 'num' => $request['num']]);
});

$router->get('/(@name)', function (?string $name = null) use ($app) {
    $app->render('home', ['title' => 'FlightPhp', 'name' => $name ?? 'world']);
})->setAlias('home');
