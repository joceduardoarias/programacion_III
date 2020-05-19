<?php
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\NotFoundException;

require __DIR__ . '/vendor/autoload.php';
include ("./entidades/usuario.php");
include ("./entidades/DAO.php");
include ("./entidades/mensaje.php");


$app = AppFactory::create();

$app->setBasePath('/parcial');

$app->post('/users', \DAO::class . ':Alta');  
$app->post('/login', \DAO::class . ':Login'); 
$app->post('/mensajes', \DAO::class . ':mensajes');
 $app->get('/mensajes', \DAO::class . ':taerListaFiltro');

// $app->get('/pizzas[/{id}]', \DAO::class . ':prueba'); //asi le paso una variable y esta se guarda en $args, esta tambien es opcional
// funciona para ruta corta como para la larga con id. 
// $app->get('/pizzas/{id}/{nombre}', \DAO::class . ':prueba'); //asi le paso una variable y esta se guarda en $args

$app->run();
