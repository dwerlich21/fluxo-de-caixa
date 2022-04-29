<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->group('/entradas', function () use ($app) {
	$app->get('/', fn(Request $request, Response $response) => $this->FinancialController->index($request, $response, 1));
	$app->post('/', fn(Request $request, Response $response) => $this->FinancialController->save($request, $response, 1));
	$app->get('/listar/[{id}/]', fn(Request $request, Response $response) => $this->FinancialController->list($request, $response, 1));
	$app->get('/novo-status/', fn(Request $request, Response $response) => $this->FinancialController->changeStatus($request, $response));
	$app->get('/{id}/', fn(Request $request, Response $response) => $this->FinancialController->data($request, $response));
});
