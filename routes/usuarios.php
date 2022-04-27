<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->group('/usuarios', function () use ($app) {
	$app->get('/', fn(Request $request, Response $response) => $this->UserController->index($request, $response));
	$app->post('/', fn(Request $request, Response $response) => $this->UserController->save($request, $response));
	$app->get('/novo-status/', fn(Request $request, Response $response) => $this->UserController->changeStatus($request, $response));
	$app->post('/editar/', fn(Request $request, Response $response) => $this->UserController->editUserSave($request, $response));
	$app->get('/meu-perfil/', fn(Request $request, Response $response) => $this->UserController->edit($request, $response));
	$app->get('/listar/[{id}/]', fn(Request $request, Response $response) => $this->UserController->list($request, $response));
});
