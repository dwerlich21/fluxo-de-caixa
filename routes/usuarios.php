<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;


$app->group('/usuarios', function () use ($app) {
	$app->get('/', fn(Request $request, Response $response) => $this->UserController->user($request, $response));
	$app->get('/meu-perfil/', fn(Request $request, Response $response) => $this->UserController->userEdit($request, $response));
	$app->get('/listar/[{id}/]', fn(Request $request, Response $response) => $this->UserController->list($request, $response));
	$app->post('/registrar/', fn(Request $request, Response $response) => $this->UserController->saveUser($request, $response));
	$app->get('/novo-status/', fn(Request $request, Response $response) => $this->UserController->changeStatus($request, $response));
	$app->post('/editar/', fn(Request $request, Response $response) => $this->UserController->editUser($request, $response));
});
