<?php
	
	use \Psr\Http\Message\ResponseInterface as Response;
	use \Psr\Http\Message\ServerRequestInterface as Request;
	
	
	$app->get('/clientes/', fn (Request $request, Response $response) => $this->CompanyController->selectCompany($request, $response));
	$app->get('/consultores/', fn (Request $request, Response $response) => $this->CompanyController->consultants($request, $response));
	
	$app->group('/empresa', function () use ($app) {
		$app->get('/', fn (Request $request, Response $response) => $this->CompanyController->company($request, $response));
		$app->get('/selecionar/', fn (Request $request, Response $response) => $this->CompanyController->selectCompany($request, $response));
		$app->post('/selecionar/', fn (Request $request, Response $response) => $this->CompanyController->selectedCompany($request, $response));
		$app->post('/registrar/', fn (Request $request, Response $response) => $this->CompanyController->saveCompany($request, $response));
		$app->get('/novo-status/', fn (Request $request, Response $response) => $this->CompanyController->changeStatus($request, $response));
	});
	
	$app->group('/empresa/setores', function () use ($app) {
		$app->post('/registrar/', fn (Request $request, Response $response) => $this->EnvironmentController->save($request, $response));
		$app->get('/novo-status/', fn (Request $request, Response $response) => $this->EnvironmentController->changeStatus($request, $response));
		$app->get('/listar/', fn (Request $request, Response $response) => $this->EnvironmentController->list($request, $response));
		$app->get('/{id}/', fn (Request $request, Response $response) => $this->EnvironmentController->data($request, $response));
	});
	
	$app->group('/empresa/cargos', function () use ($app) {
		$app->post('/registrar/', fn (Request $request, Response $response) => $this->OfficeController->save($request, $response));
		$app->get('/novo-status/', fn (Request $request, Response $response) => $this->OfficeController->changeStatus($request, $response));
		$app->get('/listar/', fn (Request $request, Response $response) => $this->OfficeController->list($request, $response));
		$app->get('/{id}/', fn (Request $request, Response $response) => $this->OfficeController->data($request, $response));
	});
	
	$app->group('/empresa/empregados', function () use ($app) {
		$app->post('/registrar/', fn (Request $request, Response $response) => $this->ProfessionalController->save($request, $response));
		$app->post('/importar/', fn (Request $request, Response $response) => $this->ProfessionalController->import($request, $response));
		$app->get('/listar/', fn (Request $request, Response $response) => $this->ProfessionalController->list($request, $response));
		$app->get('/{id}/', fn (Request $request, Response $response) => $this->ProfessionalController->data($request, $response));
	});
	
	$app->group('/empresa/processos', function () use ($app) {
		$app->post('/registrar/', fn (Request $request, Response $response) => $this->ProcessController->save($request, $response));
		$app->get('/novo-status/', fn (Request $request, Response $response) => $this->ProcessController->changeStatus($request, $response));
		$app->get('/listar/', fn (Request $request, Response $response) => $this->ProcessController->list($request, $response));
		$app->get('/{id}/', fn (Request $request, Response $response) => $this->ProcessController->data($request, $response));
	});