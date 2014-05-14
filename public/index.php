<?php
require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function () {
    readfile('index.html');
});

$app->get('/install/:host/:dbname/:username/:password', function ($host, $dbname, $username, $password) {
	ORM::configure("mysql:host={$host};dbname={$dbname}");
	ORM::configure('username', $username);
	ORM::configure('password', $password);

	$db = ORM::get_db();
	$db->exec("
	        CREATE TABLE IF NOT EXISTS users (
	            id SMALLINT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	            login VARCHAR(20), 
	            password VARCHAR(40) 
	        );"
	    );
});

$app->run();