<?php

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver'    => 'pdo_mysql',
        'host'      => 'db',
        'dbname'    => 'web',
        'user'      => 'web',
        'password'  => 'password',
        'charset'   => 'utf8',
    ]
]);

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__.'/../views',
    'twig.options' => [
        'cache' => __DIR__.'/../cache'
    ]
]);

$app->register(new Silex\Provider\SwiftmailerServiceProvider(), [
    'swiftmailer.options' => [
        'host' => 'mailcatcher',
        'port' => '1025',
    ]
]);
