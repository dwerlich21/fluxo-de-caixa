<?php

namespace App\Controllers;

use App\Models\Entities\Account;
use App\Models\Entities\User;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccountController extends Controller
{
	public function index(Request $request, Response $response)
	{
		$user = $this->getLogged();
		return $this->renderer->render($response, 'default.phtml', ['page' => "account/index.phtml", 'menuActive' => ['accounts'],
			'user' => $user, 'title' => 'Contas']);
	}
	
	public function save(Request $request, Response $response)
	{
		try {
			$user = $this->getLogged();
			if ($user->getType() > 2) exit;
			$this->em->beginTransaction();
			$data = (array)$request->getParams();
			$data['accountId'] ?? 0;
			$message = 'Conta registrada com sucesso!';
			if ($data['accountId'] == 0) {
				$verify = $this->em->getRepository(Account::class)->findOneBy(['name' => $data['name']]);
				if ($verify) throw new Exception('Conta já registrada!');
			}
			
			$account = new Account();
			if ($data['accountId'] > 0) {
				$account = $this->em->getRepository(Account::class)->find($data['accountId']);
				$message = 'Conta editada com sucesso!';
			}
			$account->setName($data['name'])
				->setActive($data['active']);
			$this->em->getRepository(Account::class)->save($account);
			
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
		$account = $this->em->getRepository(Account::class)->find($id);
		$account->setActive($status);
		$this->em->getRepository(Account::class)->save($account);
		return $response->withJson([
			'status' => 'ok',
			'message' => "Status da conta alterado para {$account->activeStr()}",
		], 201)
			->withHeader('Content-type', 'application/json');
	}
	
	public function list(Request $request, Response $response)
	{
		$user = $this->getLogged(true);
		if ($user->getType() > 2) exit;
		$filter['id'] = $request->getAttribute('route')->getArgument('id');
		$index = $request->getQueryParam('index');
		$limit = $request->getQueryParam('limit');
		$account = $this->em->getRepository(Account::class)->list($filter, $limit, $index * $limit);
		$total = $this->em->getRepository(Account::class)->listTotal($filter)['total'];
		$partial = ($index * $limit) + sizeof($account);
		$partial = $partial <= $total ? $partial : $total;
		return $response->withJson([
			'status' => 'ok',
			'message' => $account,
			'total' => (int)$total,
			'partial' => $partial,
		], 201)
			->withHeader('Content-type', 'application/json');
	}
}