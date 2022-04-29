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
			
			$verify = $this->em->getRepository(Financial::class)->findBy(['code' => $data['code']]);
			if ($verify) throw new Exception('Código já cadastrado');
			
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
				->setPrice(str_replace(',', '.', $data['price']))
				->setCode($data['code'])
				->setDescription($data['description'])
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
	
	public function changeStatus(Request $request, Response $response)
	{
		$user = $this->getLogged(true);
		if ($user->getType() != 1) exit;
		$id = $request->getQueryParam('id');
		$status = $request->getQueryParam('status');
		$u = $this->em->getRepository(User::class)->findOneBy(['client' => $id]);
		$u->setActive($status);
		$this->em->getRepository(User::class)->save($u);
		return $response->withJson([
			'status' => 'ok',
			'message' => "Status do cliente alterado para {$u->activeStr()}",
		], 201)
			->withHeader('Content-type', 'application/json');
	}
	
	public function list(Request $request, Response $response, bool $type)
	{
		$user = $this->getLogged(true);
		if ($user->getType() != 1) exit;
		$filter['id'] = $request->getAttribute('route')->getArgument('id');
		$filter['name'] = $request->getQueryParam('name');
		$filter['email'] = $request->getQueryParam('email');
		$filter['type'] = $request->getQueryParam('type');
		$filter['active'] = $request->getQueryParam('active');
		$index = $request->getQueryParam('index');
		$limit = $request->getQueryParam('limit');
		$users = $this->em->getRepository(Client::class)->list($filter, $limit, $index * $limit);
		$total = $this->em->getRepository(Client::class)->listTotal($filter)['total'];
		$partial = ($index * $limit) + sizeof($users);
		$partial = $partial <= $total ? $partial : $total;
		return $response->withJson([
			'status' => 'ok',
			'message' => $users,
			'total' => (int)$total,
			'partial' => $partial,
		], 201)
			->withHeader('Content-type', 'application/json');
	}
	
	public function data(Request $request, Response $response)
	{
		$this->getLogged(true);
		$filter['id'] = $request->getAttribute('route')->getArgument('id');
		$client = $this->em->getRepository(Client::class)->data($filter);
		return $response->withJson([
			'status' => 'ok',
			'message' => $client,
		], 200)
			->withHeader('Content-type', 'application/json');
	}
}