<?php


namespace App\Controllers;

use App\Helpers\Session;
use App\Helpers\Utils;
use App\Helpers\Validator;
use App\Models\Entities\Cnae;
use App\Models\Entities\CnaeSecondary;
use App\Models\Entities\Company;
use App\Models\Entities\Epi;
use App\Models\Entities\Occupation;
use App\Models\Entities\Office;
use App\Models\Entities\Professional;
use App\Models\Entities\Training;
use App\Models\Entities\User;

;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CompanyController extends Controller
{
	public function company(Request $request, Response $response)
	{
		$user = $this->getLogged();
		$companySelected = $this->getCompany($user);
		$offices = $this->em->getRepository(Office::class)->findBy(['company' => $companySelected->getId(), 'active' => 1], ['name' => 'asc']);
		$cnaeSecondary = $this->em->getRepository(CnaeSecondary::class)->findBy(['company' => $companySelected, 'active' => 1]);
		$sesmt = $this->getSesmt($companySelected);
		$cipa = $this->getCipa($companySelected);
		$occupations = $this->em->getRepository(Occupation::class)->findAll();
		$epis = $this->em->getRepository(Epi::class)->findAll();
		$mandatoryTrainings = $this->em->getRepository(Training::class)->findAll();
		return $this->renderer->render($response, 'default.phtml', ['page' => 'company/index.phtml', 'menuActive' => ['company'],
			'user' => $user, 'companySelected' => $companySelected, 'offices' => $offices, 'title' => 'Caracterização',
			'cnaeSecondary' => $cnaeSecondary, 'sesmt' => $sesmt, 'cipa' => $cipa, 'occupations' => $occupations, 'epis' => $epis,
			'mandatoryTrainings' => $mandatoryTrainings]);
	}
	
	public function consultants(Request $request, Response $response)
	{
		$user = $this->getLogged();
		if ($user->getType() != 2) $this->redirect('empresa');
		$companySelected = $this->getCompany($user);
		return $this->renderer->render($response, 'default.phtml', ['page' => 'company/consultants.phtml',
			'user' => $user, 'companySelected' => $companySelected, 'title' => 'Consultores']);
	}
	
	public function selectCompany(Request $request, Response $response)
	{
		$user = $this->getLogged();
		$companies = $this->em->getRepository(Company::class)->findBy(['consultant' => $user->getConsultant()->getId()], ['socialReason' => 'asc']);
		return $this->renderer->render($response, 'company/select.phtml', ['companies' => $companies, 'user' => $user]);
	}
	
	public function selectedCompany(Request $request, Response $response)
	{
		try {
			$this->getLogged();
			$data = (array)$request->getParams();
			if ($data['company'] == 0) throw new Exception('Selecione uma empresa!');
			Session::set('company', $data['company']);
			return $response->withJson([
				'status' => 'ok',
				'message' => 'Empresa selecionada com sucesso!',
			], 200)
				->withHeader('Content-type', 'application/json');
		} catch (\Exception $e) {
			return $response->withJson(['status' => 'error',
				'message' => $e->getMessage(),])->withStatus(500);
		}
	}
	
	private function saveCompanyFile($files, Company $company): Company
	{
		$folder = UPLOAD_FOLDER;
		$logoCompanyFile = $files['logoCompany'];
		if ($logoCompanyFile && $logoCompanyFile->getClientFilename()) {
			$time = time();
			$extension = explode('.', $logoCompanyFile->getClientFilename());
			$extension = end($extension);
			$target = "{$folder}{$time}logoCompanyFile.{$extension}";
			$logoCompanyFile->moveTo($target);
			$company->setLogoCompanyFile($target);
		}
		return $company;
	}
	
	public function saveCompany(Request $request, Response $response)
	{
		try {
			$user = $this->getLogged();
			$this->em->beginTransaction();
			$data = (array)$request->getParams();
			$files = $request->getUploadedFiles();
			$data['companyId'] ?? 0;
			$message = 'Empresa registada com sucesso!';
			Validator::validaCNPJ($data['cnpj']);
			$cnae = $this->em->getRepository(Cnae::class)->findOneBy(['cnae' => Utils::onlyNumbers($data['cnae'])]);
			if (!$cnae) throw new Exception('CNAE inválido!');
			$company = new Company();
			if ($data['companyId'] > 0) {
				$company = $this->em->getRepository(Company::class)->find($data['companyId']);
				$message = 'Empresa editada com sucesso!';
			}
			$company = $this->saveCompanyFile($files, $company);
			$company->setName($data['name'])
				->setResponsible($user)
				->setCnpj(Utils::onlyNumbers($data['cnpj']))
				->setCnae($cnae)
				->setSocialReason($data['socialReason'])
				->setNumbersOfWorkers($data['numbersOfWorkers'])
				->setZipCode($data['zipCode'])
				->setState($data['state'])
				->setRepresentative($data['representative'])
				->setRepresentativePosition($data['representativePosition'])
				->setState($data['state'])
				->setConsultant($user->getConsultant())
				->setNumber($data['number'])
				->setComplement($data['complement'])
				->setCity($data['city'])
				->setActive(1)
				->setObs($data['obs'])
				->setPhone($data['phone'])
				->setEmail($data['email'])
				->setPostage($data['postage'])
				->setNeighborhood($data['neighborhood'])
				->setAddress($data['address']);
			$this->em->getRepository(Company::class)->save($company);
			
			$cnaeSecondaries = $this->em->getRepository(CnaeSecondary::class)->findBy(['company' => $company, 'active' => 1]);
			foreach ($cnaeSecondaries as $item) {
				$item->setActive(0);
				$this->em->getRepository(CnaeSecondary::class)->save($item);
			}
			
			foreach ($data['cnaeSecondary'] as $item) {
				$newCnae = $this->em->getRepository(Cnae::class)->findOneBy(['cnae' => Utils::onlyNumbers($item)]);
				if ($newCnae) {
					$cnaeSecondary = new CnaeSecondary();
					$cnaeSecondary->setCompany($company)
						->setActive(1)
						->setCnae($newCnae);
					$this->em->getRepository(CnaeSecondary::class)->save($cnaeSecondary);
				}
			}
			$this->em->commit();
			Session::set('company', $company->getId());
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
	
	public function changeStatus(Request $request, Response $response)
	{
		$this->getLogged(true);
		$id = $request->getQueryParam('id');
		$status = $request->getQueryParam('status');
		$company = $this->em->getRepository(Company::class)->find($id);
		$company->setActive($status);
		if ($status == 1) {
			$description = 'Status do empresa alterado para Ativo';
		} else {
			$description = 'Status do empresa alterado para Inativo';
			$users = $this->em->getRepository(Professional::class)->changeStatus($id);
			for ($i = 0; $i < count($users); $i++) {
				$user = $this->em->getRepository(User::class)->find($users[$i]['user']);
				$user->setActive(0);
				$this->em->getRepository(User::class)->save($user);
			}
		}
		$this->em->getRepository(Company::class)->save($company);
		return $response->withJson([
			'status' => 'ok',
			'message' => $description,
		], 200)
			->withHeader('Content-type', 'application/json');
	}
}
