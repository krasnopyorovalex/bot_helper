<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application([
    'debug' => true
]);

$app->register(new Silex\Provider\DoctrineServiceProvider, [
    'db.options' => [
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'dbname' => 'helper_bot',
        'user' => 'root',
        'password' => 'toor',
        'charset' => 'utf8'
    ]
]);

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->register(new App\providers\NormalizeServiceProvider());
$app->register(new App\providers\TelegramServiceProvider());

require __DIR__ . '/../routes/routes.php';