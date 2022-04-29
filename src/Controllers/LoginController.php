<?php
	
	
	namespace App\Controllers;
	
	
	use App\Helpers\Session;
	use App\Helpers\Utils;
	use App\Helpers\Validator;
	use App\Models\Entities\AccessLog;
	use App\Models\Entities\User;
	use App\Models\Entities\RecoverPassword;
	use App\Services\Email;
	use \Psr\Http\Message\ResponseInterface as Response;
	use \Psr\Http\Message\ServerRequestInterface as Request;
	
	class LoginController extends Controller
	{
		
		public function login(Request $request, Response $response)
		{
			if (Session::get('sgsst')) {
				$this->redirect();
			}
			return $this->renderer->render($response, 'login/financialLogIn.phtml');
		}
		
		public function autentication(Request $request, Response $response)
		{
			try {
				$data = (array)$request->getParams();
				$fields = [
					'email' => 'Email',
					'password' => 'Senha',
				];
				Validator::requireValidator($fields, $data);
				$user = $this->em->getRepository(User::class)->login($data['email'], $data['password']);
				Session::set('sgsst', $user->getId());
				$this->newAccessLog($user);
				$redirect = Session::get('redirect');
				if ($redirect) {
					Session::forgot('redirect');
					$redirect = substr($redirect, 0, 1) == '/' ? substr($redirect, 1) : $redirect;
					$this->redirect($redirect);
					exit;
				}
			} catch (\Exception $e) {
				Session::set('errorMsg', $e->getMessage());
				header("Location: {$this->baseUrl}login");
				exit;
			}
			header("Location: {$this->baseUrl}empresa/selecionar");
			exit;
		}
		
		private function newAccessLog(User $user): AccessLog
		{
			$acessData = Utils::getAcessData();
			$accessLog = new AccessLog();
			$accessLog->setUser($user)
				->setIp($acessData['ip'])
				->setDevice($acessData['name'])
				->setVersion($acessData['version'])
				->setSo($acessData['platform']);
			$accessLogRepository = $this->em->getRepository(AccessLog::class);
			return $accessLogRepository->save($accessLog);
		}
		
		public function logout(Request $request, Response $response)
		{
			Session::forgot('sgsst');
			header("Location: {$this->baseUrl}login");
			exit;
		}
		
		
		public function recover(Request $request, Response $response)
		{
			return $this->renderer->render($response, 'login/recover.phtml');
		}
		
		public function changePassword(Request $request, Response $response)
		{
			$id = $request->getAttribute('route')->getArgument('id');
			$valid = true;
			$recover = $this->em->getRepository(RecoverPassword::class)->findOneBy(['token' => $id, 'used' => 0]);
			if (!$recover) {
				$valid = false;
			}
			return $this->renderer->render($response, 'login/change-password.phtml', ['id' => $id, 'valid' => $valid]);
		}
		
		public function savePassword(Request $request, Response $response)
		{
			try {
				$data = (array)$request->getParams();
				$fields = [
					'password2' => 'Confirme a senha',
					'password' => 'Senha',
				];
				$cod = $data['code-1'] . $data['code-2'] . $data['code-3'];
				$recover = $this->em->getRepository(RecoverPassword::class)->findOneBy(['token' => $data['token'], 'used' => 0]);
				if (!$recover) throw new \Exception('Token Inválido');
				if ($recover->getCod() != $cod) throw new \Exception('Código Inválido!');
				if ($data['password'] != $data['password2'])throw new \Exception('As senhas estão diferentes!');
				Validator::requireValidator($fields, $data);
				Validator::validatePassword($data);
				$user = $recover->getUser();
				$user->setPassword(password_hash($data['password'], PASSWORD_ARGON2I));
				$this->em->getRepository(User::class)->save($user);
				$recover->setUsed(1);
				$this->em->getRepository(RecoverPassword::class)->save($recover);
				return $response->withJson([
					'status' => 'ok',
					'message' => 'Senha alterada com sucesso!',
				], 200)
					->withHeader('Content-type', 'application/json');
			} catch (\Exception $e) {
				return $response->withJson([
					'status' => 'error',
					'message' => $e->getMessage(),
				])->withStatus(500);
			}
		}
		
		
		public function saveRecover(Request $request, Response $response)
		{
			try {
				$data = (array)$request->getParams();
				$fields = [
					'email' => 'Email',
				];
				Validator::requireValidator($fields, $data);
				$user = $this->em->getRepository(User::class)->findOneBy(['email' => $data['email'], 'active' => 1]);
				if (!$user) {
					throw new \Exception('Email inválido.');
				}
				$recoverPassword = new RecoverPassword();
				$token = Utils::generateToken();
				$cod = random_int(100000,999999);
				$recoverPassword->setUser($user)
					->setToken($token)
					->setCod($cod)
					->setUsed(false);
				$this->em->getRepository(RecoverPassword::class)->save($recoverPassword);
				$msg = "<p>Olá {$user->getName()}.</p>
                    <p>Segue código de verificação de e-mail para alteração de senha:</p>
                    <p style='font-size: 25px; letter-spacing: 1em; text-align: center; margin: 10px 0'>{$cod}</p>
                    <p>Insira o código no campo solicitado e faça sua alteração.</p>";
				Email::send($user->getEmail(), $user->getName(), 'Recuperação de Senha - FlashMoney', $msg);
				return $response->withJson([
					'status' => 'ok',
					'message' => 'Foi enviado um e-mail com um código para redefinição de senha.',
					'token' => $token
				], 200)
					->withHeader('Content-type', 'application/json');
			} catch (\Exception $e) {
				return $response->withJson([
					'status' => 'error',
					'message' => $e->getMessage(),
				])->withStatus(500);
			}
		}
		
	}
