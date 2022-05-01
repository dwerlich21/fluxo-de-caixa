<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->group('/contas', function () use ($app) {
	$app->get('/', fn(Request $request, Response $response) => $this->AccountController->index($request, $response));
	$app->post('/', fn(Request $request, Response $response) => $this->AccountController->save($request, $response));
	$app->get('/novo-status/', fn(Request $request, Response $response) => $this->AccountController->changeStatus($request, $response));
	$app->get('/listar/[{id}/]', fn(Request $request, Response $response) => $this->AccountController->list($request, $response));
});
