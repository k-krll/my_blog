<?php
require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function () {
    readfile('index.html');
});

$app->run();