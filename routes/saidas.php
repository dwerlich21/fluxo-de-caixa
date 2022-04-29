<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->group('/saidas', function () use ($app) {
	$app->get('/', fn(Request $request, Response $response) => $this->FinancialController->index($request, $response, 0));
	$app->post('/', fn(Request $request, Response $response) => $this->FinancialController->save($request, $response, 0));
	$app->get('/listar/', fn(Request $request, Response $response) => $this->FinancialController->list($request, $response, 0));
	$app->get('/novo-status/', fn(Request $request, Response $response) => $this->FinancialController->changeStatus($request, $response));
	$app->get('/{id}/', fn(Request $request, Response $response) => $this->FinancialController->data($request, $response));
});
