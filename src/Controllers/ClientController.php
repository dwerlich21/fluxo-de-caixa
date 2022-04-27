<?php

namespace App\Controllers;

use App\helpers\Validator;
use App\Models\Entities\User;
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
			'user' => $user, 'users' => $users, 'title' => 'Usuários']);
	}
	
	public function edit(Request $request, Response $response)
	{
		$user = $this->getLogged();
		return $this->renderer->render($response, 'default.phtml', ['page' => 'users/userEdit.phtml',
			'user' => $user, 'title' => 'Meu Perfil']);
	}
	
	public function save(Request $request, Response $response)
	{
		try {
			$user = $this->getLogged();
			if ($user->getType() != 1) exit;
			$data = (array)$request->getParams();
			$data['userId'] ?? 0;
			$fields = [
				'name' => 'Nome',
				'email' => 'E-mail',
				'type' => 'Tipo'
			];
			$message = 'Usuário registrado com sucesso!';
			Validator::requireValidator($fields, $data);
			if ($data['userId'] == 0) {
				$verify = $this->em->getRepository(User::class)->findOneBy(['email' => $data['email']]);
				if ($verify) throw new Exception('E-mail já registrado!');
			}
			$user = new User();
			if ($data['userId'] > 0) {
				$user = $this->em->getRepository(User::class)->find($data['userId']);
				$message = 'Usuário editado com sucesso!';
			}
			
			$user->setName($data['name'])
				->setEmail($data['email'])
				->setType($data['type']);
			if ($data['userId'] == 0) {
				$user->setActive(1)
					->setPassword(password_hash($data['password'], PASSWORD_ARGON2I));
			}
			$this->em->getRepository(User::class)->save($user);
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
		$u = $this->em->getRepository(User::class)->find($id);
		$u->setActive($status);
		$this->em->getRepository(User::class)->save($u);
		return $response->withJson([
			'status' => 'ok',
			'message' => "Status do usuário alterado para {$u->activeStr()}",
		], 201)
			->withHeader('Content-type', 'application/json');
	}
	
	public function editUserSave(Request $request, Response $response)
	{
		try {
			$user = $this->getLogged();
			$this->em->beginTransaction();
			$data = (array)$request->getParams();
			$files = $request->getUploadedFiles();
			$fields = [
				'password' => 'Senha Atual',
				'email' => 'Email',
				'name' => 'Name',
				'newPassword' => 'Nova Senha',
				'newPassword2' => 'Confirmar Nova Senha',
			];
			Validator::requireValidator($fields, $data);
			if (!password_verify($data['newPassword'], $user->getPassword())) throw new Exception('Senha Atual Incorreta!');
			if ($data['newPassword'] != $data['newPassword2']) throw new Exception('As senhas não são iguais!');
			$user = $this->saveUserImg($files, $user);
			$user->setEmail($data['email'])
				->setName($data['name'])
				->setPassword(password_hash($data['password'], PASSWORD_ARGON2I));
			$this->em->getRepository(User::class)->save($user);
			$this->em->commit();
			return $response->withJson([
				'status' => 'ok',
				'message' => 'Usuário editado com sucesso!',
			], 201)
				->withHeader('Content-type', 'application/json');
		} catch (\Exception $e) {
			return $response->withJson(['status' => 'error',
				'message' => $e->getMessage(),])->withStatus(500);
		}
	}
	
	private function saveUserImg($files, User $user): User
	{
		$folder = UPLOAD_FOLDER;
		$imgUserFile = $files['imgUser'];
		if ($imgUserFile && $imgUserFile->getClientFilename()) {
			$time = time();
			$extension = explode('.', $imgUserFile->getClientFilename());
			$extension = end($extension);
			$target = "{$folder}{$time}imgUserFile.{$extension}";
			$imgUserFile->moveTo($target);
			$user->setImg($target);
		}
		return $user;
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
		$users = $this->em->getRepository(User::class)->list($filter, $limit, $index * $limit);
		$total = $this->em->getRepository(User::class)->listTotal($filter)['total'];
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
}