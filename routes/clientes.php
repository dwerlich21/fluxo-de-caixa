<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->group('/clientes', function () use ($app) {
	$app->get('/', fn(Request $request, Response $response) => $this->ClientController->index($request, $response));
	$app->post('/', fn(Request $request, Response $response) => $this->ClientController->save($request, $response));
	$app->get('/novo-status/', fn(Request $request, Response $response) => $this->ClientController->changeStatus($request, $response));
	$app->get('/listar/', fn(Request $request, Response $response) => $this->ClientController->list($request, $response));
	$app->get('/{id}/', fn(Request $request, Response $response) => $this->ClientController->data($request, $response));
});
