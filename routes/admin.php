<?php
	
	use \Psr\Http\Message\ResponseInterface as Response;
	use \Psr\Http\Message\ServerRequestInterface as Request;
	
	$app->get('/', fn (Request $request, Response $response) => $this->AdminController->index($request, $response));
	$app->get('/importar/', fn (Request $request, Response $response) => $this->AdminController->arquivo($request, $response));
	$app->get('/word/', fn (Request $request, Response $response) => $this->AdminController->word($request, $response));
	$app->get('/imagem/', fn (Request $request, Response $response) => $this->AdminController->img($request, $response));
	$app->post('/arquivo/', fn (Request $request, Response $response) => $this->AdminController->import($request, $response));
	$app->get('/cadastrar/', fn (Request $request, Response $response) => $this->AdminController->register($request, $response));
	$app->post('/cadastrar/', fn (Request $request, Response $response) => $this->AdminController->newRegister($request, $response));
 
