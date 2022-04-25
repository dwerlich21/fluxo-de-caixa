<?php

namespace App\Controllers;

use App\Helpers\Utils;
use App\Helpers\Validator;
use App\Models\Entities\Consultant;
use App\Models\Entities\DocumentBase;
use App\Models\Entities\PaymentPlan;
use App\Models\Entities\User;
use CreateDocx;
use Exception;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class AdminController extends Controller
{
	
	public function index(Request $request, Response $response)
	{
		$user = $this->getLogged();
		$companySelected = $this->getCompany($user);
		if (!$companySelected) {
			$this->redirect('empresa/selecionar');
			exit;
		}
		
		return $this->renderer->render($response, 'default.phtml', ['page' => 'index.phtml', 'menuActive' => ['dashboard'],
			'user' => $user, 'companySelected' => $companySelected, 'title' => 'Dashboard']);
	}
	
	public function register(Request $request, Response $response)
	{
		return $this->renderer->render($response, 'login/register.phtml');
	}
	
	//Criar nova conta no Sistema
	public function newRegister(Request $request, Response $response)
	{
//			Tipos de Usuários:
//			1 - Admin do Sistema
//			2 - Consultor Master
//			3 - Consultor Júnior
		try {
			$data = (array)$request->getParams();
			$this->em->beginTransaction();
			$files = $request->getUploadedFiles();
			
			if ($data['cpf'] != '') Validator::validateCPF($data['cpf']);
			if ($data['cnpj'] != '') Validator::validaCNPJ($data['cnpj']);
			if ($data['termsOfUse'] && $data['termsOfUse'] != 1) throw new Exception('Você concorda com nossos Termos de Uso e Políticas de Privacidade?');
			
			if ($data['cnpf'] != '') $consultantNew = $this->em->getRepository(Consultant::class)->findOneBy(['cnpf' => Utils::onlyNumbers($data['cnpf'])]);
			if ($consultantNew) throw new Exception('CNPJ já cadastrado!');
			
			if ($data['cpf'] != '') $consultantNew = $this->em->getRepository(Consultant::class)->findOneBy(['cpf' => Utils::onlyNumbers($data['cpf'])]);
			if ($consultantNew) throw new Exception('CPF já cadastrado!');
			
			$userNew = $this->em->getRepository(User::class)->findOneBy(['email' => $data['email']]);
			if ($userNew) throw new Exception('E-mail de usuário já cadastrado!');
			
			$consultant = new Consultant();
			$consultant->setAddress($data['address'])
				->setName($data['consultant'])
				->setNeighborhood($data['neighborhood'])
				->setCity($data['city'])
				->setState($data['uf'])
				->setZipCode($data['zipCode'])
				->setCnpj($data['cnpf'] ? Utils::onlyNumbers($data['cnpf']) : '')
				->setCpf($data['cpf'] ? Utils::onlyNumbers($data['cpf']) : '')
				->setNumber($data['number'])
				->setComplement($data['complement'])
				->setEmail($data['email'])
				->setPhone($data['phone']);
			$consultant = $this->saveConsultantFile($files, $consultant);
			$this->em->getRepository(Consultant::class)->save($consultant);
			
			$payment = new PaymentPlan();
			$payment->setConsultant($consultant);
			$this->em->getRepository(PaymentPlan::class)->save($payment);
			
			$users = new User();
			$users->setEmail($data['email'])
				->setName($data['name'])
				->setConsultant($consultant)
				->setType(2)
				->setActive(1)
				->setTermsOfUse(1)
				->setPassword(password_hash($data['password'], PASSWORD_ARGON2I));;
			$this->em->getRepository(User::class)->save($users);
			$this->em->commit();
			return $response->withJson([
				'status' => 'ok',
				'message' => 'Cadastro realizado com sucesso!',
			], 200)
				->withHeader('Content-type', 'application/json');
		} catch (\Exception $e) {
			return $response->withJson(['status' => 'error',
				'message' => $e->getMessage(),])->withStatus(500);
		}
	}
	
	private function saveConsultantFile($files, Consultant $users): Consultant
	{
		$folder = UPLOAD_FOLDER;
		$logoCompanyFile = $files['logoCompany'];
		
		if ($logoCompanyFile && $logoCompanyFile->getClientFilename()) {
			$time = time();
			$extension = explode('.', $logoCompanyFile->getClientFilename());
			$extension = end($extension);
			$target = "{$folder}{$time}logoCompanyFile.{$extension}";
			$logoCompanyFile->moveTo($target);
			$users->setLogoConsultantFile($target);
		}
		return $users;
	}
	
	public function arquivo(Request $request, Response $response)
	{
		$user = $this->getLogged();
		$companySelected = $this->getCompany($user);
		return $this->renderer->render($response, 'default.phtml', ['page' => 'import.phtml', 'menuActive' => ['dashboard'],
			'user' => $user, 'companySelected' => $companySelected, 'title' => 'Dashboard']);
	}
	
	public function img(Request $request, Response $response)
	{
		$user = $this->getLogged();
		$companySelected = $this->getCompany($user);
		return $this->renderer->render($response, 'default.phtml', ['page' => 'img.phtml', 'menuActive' => ['dashboard'],
			'user' => $user, 'companySelected' => $companySelected, 'title' => 'Dashboard']);
	}
	
	public function word()
	{
		$documentBase = $this->em->getRepository(DocumentBase::class)->findOneBy(['id' => 1]);
		$html = $documentBase->getPresentation();
		
		$pw = new PhpWord();
		$section = $pw->addSection();
		Html::addHtml($section, $documentBase->getTechnicalTerms(), false, false);
		
		$pw->save('html.docx', 'Word2007');
	}
	
	public function word1()
	{
		$htd = new HTML_TO_DOC();
		$htmlContent = '
		    <h1>Hello World!</h1>
		    <p>This document is created from HTML.</p>';
		$doc = $htd->createDoc($htmlContent, "my-document");
		
		if ($doc) {
			echo 'Criado';
		} else {
			echo 'Erro';
		}
	}
	
	public function import(Request $request, Response $response)
	{
		$arquivo = $_FILES['attendanceFile']['tmp_name'];
		
		$parser = new \Smalot\PdfParser\Parser();
		$pdf = $parser->parseFile($arquivo);
		
		
		$text = $pdf->getText();
		die(var_dump($pdf->getText()));
		echo $text;
//		$insert = "INSERT INTO training (training) VALUES";
//		set_time_limit(0);
//		ini_set("memory_limit", -1);
//		ignore_user_abort(1);
//
//		$handle = fopen($_FILES['attendanceFile']['tmp_name'], "r");
//
//		if ($handle !== FALSE) {
//			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
//				$data1[] = array_map("utf8_encode", $data);
//
//
//
//				$insert .= "('{$data[0]}'), <br>";
//			}
//
//		}
//		echo $insert;
	}
}


