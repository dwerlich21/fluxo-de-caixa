<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->group('/extratos', function () use ($app) {
	$app->get('/', fn(Request $request, Response $response) => $this->FinancialController->extract($request, $response));
	$app->get('/listar/', fn(Request $request, Response $response) => $this->FinancialController->list($request, $response));
});
