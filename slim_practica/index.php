<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\NotFoundException;

require __DIR__ . '/vendor/autoload.php';
include ("./entidades/usuario.php");
include ("./entidades/DAO.php");
include ("./entidades/pizza.php");

// $app->setBasePath("/slim");

$app = AppFactory::create();

$app->setBasePath('/slim_practica');

$app->post('/usuario', \DAO::class . ':Alta');  
$app->post('/login', \DAO::class . ':Login'); 
$app->post('/pizzas', \DAO::class . ':AltaPizza');
$app->run();
