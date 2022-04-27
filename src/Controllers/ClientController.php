<?php

namespace App\Controllers;

use App\Helpers\Validator;
use App\Models\Entities\Client;
use App\Models\Entities\User;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ClientController extends Controller
{
	public function index(Request $request, Response $response)
	{
		$user = $this->getLogged();
		if ($user->getType() > 2) $this->redirect('extratos');
		$users = $this->em->getRepository(User::class)->findBy([], ['name' => 'asc']);
		return $this->renderer->render($response, 'default.phtml', ['page' => 'clients/index.phtml', 'menuActive' => ['clients'],
			'user' => $user, 'users' => $users, 'title' => 'Clientes']);
	}
	
	public function save(Request $request, Response $response)
	{
		try {
			$user = $this->getLogged();
			if ($user->getType() > 2) exit;
			$this->em->beginTransaction();
			$data = (array)$request->getParams();
			$data['clientId'] ?? 0;
			$message = 'Cliente registrado com sucesso!';
			if ($data['clientId'] == 0) {
				$verify = $this->em->getRepository(User::class)->findOneBy(['email' => $data['email']]);
				if ($verify) throw new Exception('E-mail já registrado!');
			}
			
			// Salvar Cliente
			$client = new Client();
			if ($data['clientId'] > 0) {
				$client = $this->em->getRepository(Client::class)->find($data['clientId']);
				$message = 'Cliente editado com sucesso!';
			}
			$client->setCity($data['city'])
				->setPhone($data['phone'])
				->setCountry($data['country']);
			$this->em->getRepository(Client::class)->save($client);
			
			// Salvar dados de Acesso do Cliente
			$user = new User();
			if ($data['clientId'] > 0) {
				$user = $this->em->getRepository(User::class)->findOneBy(['client' => $client]);
			}
			$user->setName($data['name'])
				->setEmail($data['email'])
				->setClient($client)
				->setType(3);
			if ($data['clientId'] == 0) {
				$user->setActive($data['active'])
					->setPassword(password_hash($data['password'], PASSWORD_ARGON2I));
			}
			$this->em->getRepository(User::class)->save($user);
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
	
	public function list(Request $request, Response $response)
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