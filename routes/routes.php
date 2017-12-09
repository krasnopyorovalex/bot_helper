<?php

use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;

use App\repository\MessagesRepository;
use App\MessagesModel;

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig');
});

$app->post('/get-messages', function (Request $request) use ($app) {
    (new MessagesModel($app['db']->createQueryBuilder(), $request))->updateStatusMessages();
    return $app->json((new MessagesRepository($app))->findAll());
});

$app->post('/set-message', function (Request $request) use ($app) {
    return (new MessagesModel($app['db']->createQueryBuilder(), $request))->setMessage();
    //return $app->json((new MessagesRepository($app))->findAll());
});

$app->post('/set-favorite', function (Request $request) use ($app) {
    return (new MessagesModel($app['db']->createQueryBuilder(), $request))->setFavorite();
});