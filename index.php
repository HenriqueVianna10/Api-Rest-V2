<?php
use Slim\Factory\AppFactory;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


include_once('UsuarioController.php');
include_once('LojaController.php');

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->post('/api/usuarios','UsuarioController:inserir');

$app->group('/api/loja', function($app){
    $app->get('', 'LojaController:listar');
    $app->get('/search','LojaController:buscarPorQuery');
    $app->post('', 'LojaController:inserir');
    $app->get('/{id}', 'LojaController:buscarPorId');    
    $app->put('/{id}', 'LojaController:atualizar');
    $app->delete('/{id}', 'LojaController:deletar');
})->add('UsuarioController:validarToken');

$app->post('/api/auth','UsuarioController:autenticar');

$app->run();
?>