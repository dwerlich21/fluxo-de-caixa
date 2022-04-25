<?php
namespace App\Controllers;

use App\Helpers\Validator;
use App\Models\Entities\User;
use Exception;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
class UserController extends Controller
{
	public function user(Request $request, Response $response)
	{
		$user = $this->getLogged();
		if ($user->getType() != 1) $this->redirect('empresa');
		$companySelected = $this->getCompany($user);
		return $this->renderer->render($response, 'default.phtml', ['page' => 'users/index.phtml', 'menuActive' => ['users'],
			'user' => $user, 'companySelected' => $companySelected, 'title' => 'Usuários']);
	}
	
	public function userEdit(Request $request, Response $response)
	{
		$user = $this->getLogged();
		$companySelected = $this->getCompany($user);
		return $this->renderer->render($response, 'default.phtml', ['page' => 'users/userEdit.phtml', 'menuActive' => ['users'],
			'user' => $user, 'companySelected' => $companySelected, 'title' => 'Editar Usuário']);
	}
	
	public function saveUser(Request $request, Response $response)
	{
		try {
			$this->getLogged();
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
				->setTermsOfUse(1)
				->setConsultant($user->getConsultant())
				->setType($data['type']);
			if ($data['userId'] == 0) {
				$user->setActive(1)
					->setPassword(password_hash($data['password'], PASSWORD_ARGON2I));
			}
			$this->em->getRepository(User::class)->save($user);
			return $response->withJson([
				'status' => 'ok',
				'message' => $message,
			], 200)
				->withHeader('Content-type', 'application/json');
		} catch (\Exception $e) {
			return $response->withJson(['status' => 'error',
				'message' => $e->getMessage(),])->withStatus(500);
		}
	}
	
	public function editUser(Request $request, Response $response)
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
			if ($data['newPassword'] != $data['newPassword2']) throw new Exception('As senha estão diferentes!');
			$user = $this->saveUserImg($files, $user);
			$user->setEmail($data['email'])
				->setName($data['name'])
				->setPassword(password_hash($data['password'], PASSWORD_ARGON2I));
			$this->em->getRepository(User::class)->save($user);
			$this->em->commit();
			return $response->withJson([
				'status' => 'ok',
				'message' => 'Usuário editado com sucesso!',
			], 200)
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
	
	public function changeStatus(Request $request, Response $response)
	{
		$this->getLogged(true);
		$id = $request->getQueryParam('id');
		$status = $request->getQueryParam('status');
		$user = $this->em->getRepository(User::class)->find($id);
		$user->setActive($status);
		if ($status == 1) {
			$description = 'Status do consultor alterado para Ativo';
		} else {
			$description = 'Status do consultor alterado para Inativo';
		}
		$this->em->getRepository(User::class)->save($user);
		return $response->withJson([
			'status' => 'ok',
			'message' => $description,
		], 200)
			->withHeader('Content-type', 'application/json');
	}
	
	public function list(Request $request, Response $response)
	{
		$user = $this->getLogged(true);
		$id = $request->getAttribute('route')->getArgument('id');
		$name = $request->getQueryParam('name');
		$type = $request->getQueryParam('type');
		$index = $request->getQueryParam('index');
		$users = $this->em->getRepository(User::class)->list($user, $id, $name, $type, 20, $index * 20);
		$total = $this->em->getRepository(User::class)->listTotal($user, $id, $name, $type)['total'];
		$partial = ($index * 20) + sizeof($users);
		$partial = $partial <= $total ? $partial : $total;
		return $response->withJson([
			'status' => 'ok',
			'message' => $users,
			'total' => (int)$total,
			'partial' => $partial,
		], 200)
			->withHeader('Content-type', 'application/json');
	}
}