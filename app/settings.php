<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver'   => 'mysql',
            'host'     => 'db',
            'database' => 'ticketing',
            'username' => 'root',
            'password' => 'nrd113',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

        'lang' => [
            'default' => 'en',
        ],
    ]
]);
