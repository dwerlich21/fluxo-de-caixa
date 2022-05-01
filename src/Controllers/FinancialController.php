<?php

namespace App\Controllers;

use App\Helpers\Utils;
use App\Models\Entities\Client;
use App\Models\Entities\Financial;
use App\Models\Entities\User;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class FinancialController extends Controller
{
	public function index(Request $request, Response $response, bool $type)
	{
		$user = $this->getLogged();
		if ($user->getType() > 2) $this->redirect('extratos');
		if ($type == 1) {
			$title = 'Entradas';
			$menu = 'log-in';
			$page = 'financialLogIn.phtml';
		} else {
			$title = 'Saídas';
			$menu = 'log-out';
			$page = 'financialLogOut.phtml';
		}
		$clients = $this->em->getRepository(User::class)->findBy(['type' => 3, 'active' => 1], ['name' => 'asc']);
		return $this->renderer->render($response, 'default.phtml', ['page' => "financial/{$page}", 'menuActive' => [$menu],
			'user' => $user, 'clients' => $clients, 'title' => $title, 'type' => $type]);
	}
	
	public function extract(Request $request, Response $response)
	{
		$user = $this->getLogged();
		$clients = $this->em->getRepository(User::class)->findBy(['type' => 3, 'active' => 1], ['name' => 'asc']);
		return $this->renderer->render($response, 'default.phtml', ['page' => "financial/extract.phtml", 'menuActive' => ['extract'],
			'user' => $user, 'clients' => $clients, 'title' => 'Extratos']);
	}
	
	public function save(Request $request, Response $response, bool $type)
	{
		try {
			$user = $this->getLogged();
			if ($user->getType() > 2) exit;
			$this->em->beginTransaction();
			if ($type == 1) {
				$single = 'Entrada';
			} else {
				$single = 'Saída';
			}
			$data = (array)$request->getParams();
			$data['financialId'] ?? 0;
			$message = "{$single} registrada com sucesso!";
			
			if ($type === true) {
				$verify = $this->em->getRepository(Financial::class)->findOneBy(['code' => $data['code']]);
				if ($verify && $verify->getId() != $data['financialId']) throw new Exception('Código já cadastrado');
			}
			
			$financial = new Financial();
			if ($data['financialId'] > 0) {
				$financial = $this->em->getRepository(Financial::class)->find($data['financialId']);
				$message = "{$single} editada com sucesso!";
			}
			
			$financial->setType($type)
				->setClient($this->em->getReference(Client::class, $data['client']))
				->setDestiny($data['destiny'])
				->setValuePeso(Utils::setFloat($data['valuePeso']))
				->setValueReal(Utils::setFloat($data['valueReal']))
				->setPrice($data['price'] ? str_replace(',', '.', $data['price']) : null)
				->setCode($data['code'])
				->setDescription($data['description'])
				->setSender($data['sender'])
				->setStatus(1)
				->setDate(\DateTime::createFromFormat('d/m/Y', $data['date']));
			$this->em->getRepository(Financial::class)->save($financial);
			
			$this->em->commit();
			return $response->withJson([
				'status' => 'ok',
				'message' => $message,
			], 201)
				->withHeader('Content-type', 'application/json');
		} catch (\Exception $e) {
			return $response->withJson(['status' => 'error',
				'message' => $e->getMessage(),])->withStatus(500);
		}
	}
	
	public function delete(Request $request, Response $response, bool $type)
	{
		$user = $this->getLogged(true);
		if ($user->getType() != 1) exit;
		$id = $request->getAttribute('route')->getArgument('id');
		if ($type === true) {
			$message = 'Entrada excluída com sucesso!';
		} else {
			$message = 'Saída excluída com sucesso!';
		}
		$financial = $this->em->getRepository(Financial::class)->find($id);
		$financial->setStatus(0);
		$this->em->getRepository(Financial::class)->save($financial);
		return $response->withJson([
			'status' => 'ok',
			'message' => $message,
		], 201)
			->withHeader('Content-type', 'application/json');
	}
	
	public function list(Request $request, Response $response, int $type)
	{
		$user = $this->getLogged(true);
		if ($user->getType() > 2) exit;
		$filter['id'] = $request->getAttribute('route')->getArgument('id');
		$filter['client'] = $request->getQueryParam('client');
		$filter['destiny'] = $request->getQueryParam('destiny');
		$filter['code'] = $request->getQueryParam('code');
		$filter['type'] = $type;
		$index = $request->getQueryParam('index');
		$limit = $request->getQueryParam('limit');
		$financial = $this->em->getRepository(Financial::class)->list($filter, $limit, $index * $limit);
		$total = $this->em->getRepository(Financial::class)->listTotal($filter)['total'];
		$partial = ($index * $limit) + sizeof($financial);
		$partial = $partial <= $total ? $partial : $total;
		return $response->withJson([
			'status' => 'ok',
			'message' => $financial,
			'total' => (int)$total,
			'partial' => $partial,
		], 201)
			->withHeader('Content-type', 'application/json');
	}
	
	public function data(Request $request, Response $response)
	{
		$user = $this->getLogged(true);
		if ($user->getType() != 1) exit;
		$filter['id'] = $request->getAttribute('route')->getArgument('id');
		$client = $this->em->getRepository(Financial::class)->list($filter);
		return $response->withJson([
			'status' => 'ok',
			'message' => $client,
		], 200)
			->withHeader('Content-type', 'application/json');
	}
	
	public function listExtract(Request $request, Response $response)
	{
		$user = $this->getLogged(true);
		$filter['id'] = $request->getAttribute('route')->getArgument('id');
		$filter['client'] = $request->getQueryParam('client');
		if ($user->getType() == 3) $filter['client'] = $user->getClient()->getId();
		$filter['destiny'] = $request->getQueryParam('destiny');
		$filter['start'] = $request->getQueryParam('start');
		$filter['end'] = $request->getQueryParam('end');
		$index = $request->getQueryParam('index');
		$limit = $request->getQueryParam('limit');
		$financial = $this->em->getRepository(Financial::class)->list($filter, $limit, $index * $limit);
		$total = $this->em->getRepository(Financial::class)->listTotal($filter)['total'];
		$balance['logIn'] = $this->em->getRepository(Financial::class)->balanceLogIn($filter)['logIn'];
		$balance['logOut'] = $this->em->getRepository(Financial::class)->balanceLogOut($filter)['logOut'];
		if ($balance['logIn'] == null) $balance['logIn'] = 0;
		if ($balance['logOut'] == null) $balance['logOut'] = 0;
		$balance = floatval($balance['logIn']) - floatval($balance['logOut']);
		$partial = ($index * $limit) + sizeof($financial);
		$partial = $partial <= $total ? $partial : $total;
		return $response->withJson([
			'status' => 'ok',
			'message' => $financial,
			'total' => (int)$total,
			'partial' => $partial,
			'balance' => $balance
		], 201)
			->withHeader('Content-type', 'application/json');
	}
}