<?php

$container = new \Slim\Container;

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

//Container untuk database
$container['db'] = function ($container) use ($capsule){
    return $capsule;
};

$container['validation'] = function ($c) {
	$setting = $c->get('settings')['lang']['default'];
	$param = $c['request']->getParams();

	return new \Valitron\Validator($param, [], $setting);
};
