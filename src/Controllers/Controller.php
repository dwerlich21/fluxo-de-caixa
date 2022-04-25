<?php

namespace App\Controllers;

use App\Models\Entities\Cipa;
use App\Models\Entities\Company;
use App\Models\Entities\Danger;
use App\Models\Entities\DangerGes;
use App\Models\Entities\Sesmt;
use App\Models\Entities\Tool01;
use App\Models\Entities\Tool02;
use App\Models\Entities\Tool03;
use App\Models\Entities\Tool04;
use App\Models\Entities\Tool05;
use App\Models\Entities\Tool07;
use App\Models\Entities\User;
use Doctrine\ORM\EntityManager;
use App\Helpers\Session;

abstract class Controller
{
	protected $em;
	protected $renderer;
	protected $baseUrl = BASEURL;
	protected $env = ENV;
	
	public function __construct(EntityManager $entityManager, $renderer)
	{
		$this->em = $entityManager;
		$this->renderer = $renderer;
	}
	
	protected function getLogged(bool $excepetion = false)
	{
		$user = Session::get('sgsst');
		if (!$user) {
			if ($excepetion) throw new \Exception("Sessão expirada");
			Session::set('redirect', $_SERVER["REQUEST_URI"]);
			Session::set('errorMsg', 'Você precisa se autenticar');
			$this->redirect('login');
			exit;
		}
		$user = $this->em->getRepository(User::class)->find($user);
		return $user;
	}
	
	protected function getCompany(User $user)
	{
		$company = Session::get('company');
		if (!$company) {
			$this->redirect('empresa/selecionar');
			exit;
		}
		$company = $this->em->getRepository(Company::class)->find($company);
		return $company;
	}
	
	protected function redirect(string $url = '')
	{
		header("Location: {$this->baseUrl}{$url}");
		die();
	}
	
	protected function getSesmt(Company $company)
	{
		if ($company->getNumbersOfWorkers() < 50) $levelOfWorkers = 1;
		if ($company->getNumbersOfWorkers() > 49 && $company->getNumbersOfWorkers() < 101) $levelOfWorkers = 2;
		if ($company->getNumbersOfWorkers() > 100 && $company->getNumbersOfWorkers() < 251) $levelOfWorkers = 3;
		if ($company->getNumbersOfWorkers() > 250 && $company->getNumbersOfWorkers() < 501) $levelOfWorkers = 4;
		if ($company->getNumbersOfWorkers() > 500 && $company->getNumbersOfWorkers() < 1001) $levelOfWorkers = 5;
		if ($company->getNumbersOfWorkers() > 1000 && $company->getNumbersOfWorkers() < 2001) $levelOfWorkers = 6;
		if ($company->getNumbersOfWorkers() > 2000 && $company->getNumbersOfWorkers() < 3501) $levelOfWorkers = 7;
		if ($company->getNumbersOfWorkers() > 3500 && $company->getNumbersOfWorkers() < 7001) $levelOfWorkers = 8;
		if ($company->getNumbersOfWorkers() > 7000 && $company->getNumbersOfWorkers() < 11001) $levelOfWorkers = 9;
		if ($company->getNumbersOfWorkers() > 11000 && $company->getNumbersOfWorkers() < 15001) $levelOfWorkers = 10;
		if ($company->getNumbersOfWorkers() > 15000 && $company->getNumbersOfWorkers() < 19001) $levelOfWorkers = 11;
		if ($company->getNumbersOfWorkers() > 19000 && $company->getNumbersOfWorkers() < 21001) $levelOfWorkers = 12;
		
		return $this->em->getRepository(Sesmt::class)->findOneBy(['degreeOfRisk' => $company->getCnae()->getRiskCnae(), 'levelOfWorkers' => $levelOfWorkers]);
	}
	
	protected function getCipa(Company $company)
	{
		if ($company->getNumbersOfWorkers() < 20) $levelOfWorkers = 1;
		if ($company->getNumbersOfWorkers() > 19 && $company->getNumbersOfWorkers() < 30) $levelOfWorkers = 2;
		if ($company->getNumbersOfWorkers() > 29 && $company->getNumbersOfWorkers() < 51) $levelOfWorkers = 3;
		if ($company->getNumbersOfWorkers() > 50 && $company->getNumbersOfWorkers() < 81) $levelOfWorkers = 4;
		if ($company->getNumbersOfWorkers() > 80 && $company->getNumbersOfWorkers() < 101) $levelOfWorkers = 5;
		if ($company->getNumbersOfWorkers() > 100 && $company->getNumbersOfWorkers() < 121) $levelOfWorkers = 6;
		if ($company->getNumbersOfWorkers() > 120 && $company->getNumbersOfWorkers() < 141) $levelOfWorkers = 7;
		if ($company->getNumbersOfWorkers() > 140 && $company->getNumbersOfWorkers() < 301) $levelOfWorkers = 8;
		if ($company->getNumbersOfWorkers() > 300 && $company->getNumbersOfWorkers() < 501) $levelOfWorkers = 9;
		if ($company->getNumbersOfWorkers() > 500 && $company->getNumbersOfWorkers() < 1001) $levelOfWorkers = 10;
		if ($company->getNumbersOfWorkers() > 1000 && $company->getNumbersOfWorkers() < 2501) $levelOfWorkers = 11;
		if ($company->getNumbersOfWorkers() > 2500 && $company->getNumbersOfWorkers() < 5001) $levelOfWorkers = 12;
		if ($company->getNumbersOfWorkers() > 5000 && $company->getNumbersOfWorkers() < 12500) $levelOfWorkers = 13;
		if ($company->getNumbersOfWorkers() > 12499 && $company->getNumbersOfWorkers() < 15000) $levelOfWorkers = 14;
		if ($company->getNumbersOfWorkers() > 14999 && $company->getNumbersOfWorkers() < 17500) $levelOfWorkers = 15;
		if ($company->getNumbersOfWorkers() > 17499 && $company->getNumbersOfWorkers() < 2000) $levelOfWorkers = 16;
		
		return $this->em->getRepository(Cipa::class)->findOneBy(['degreeOfRisk' => $company->getCnae()->getRiskCnae(), 'levelOfWorkers' => $levelOfWorkers]);
	}
	
	// Gerar Invetário de Riscos
	protected function generateRiskInventory()
	{
		$user = $this->getLogged();
		$companySelected = $this->getCompany($user);
		
		//Pegar Perigos cadastrados na Empresa
		$dangers = $this->em->getRepository(Danger::class)->findBy(['company' => $companySelected, 'status' => 1], ['danger' => 'asc']);
		$html = "
			<!DOCTYPE html>
			<html lang=\"pt-br\">
				  <head>
					<title>Inventário de Risco - {$companySelected->getSocialReason()}</title>
				  </head>
			<body>
            <table class=\"table table-bordered\" width=\"100%\" cellspacing=\"0\" id='tableRiskInventory'>
            <thead>
            <tr class=\"middle\">
                <th class='text-center upper' colspan='9'>Identificação de Perigos</th>
                <th class='text-center upper' colspan='7'>Análise Preliminar/Monitoramento das Exposições</th>
                <th class='text-center upper' colspan='3'>Avaliação de Riscos</th>
			</tr>
            <tr class=\"middle\">
              <th class=\"text-center \">Item</th>
              <th class=\"text-center \">Perigo / Fator de Risco</th>
              <th class=\"text-center\">Processo</th>
              <th class=\"text-center\">Ambiente</th>
              <th class=\"text-center\">Fontes ou Cirscunstâncias</th>
              <th class=\"text-center\">Duração / Frequência</th>
              <th class=\"text-center\">Possíveis lesões, Agravos ou Danos a Saúde</th>
              <th class=\"text-center\">Grupo de Trabalhadores Sujeitos ao Risco (GES)</th>
              <th class=\"text-center\">Medidas de Prevenção Implementadas</th>
              <th class=\"text-center\">Riscos</th>
              <th class=\"text-center\">Intens / Concent.</th>
              <th class=\"text-center\">Legis Alplicável</th>
              <th class=\"text-center\">Critério Avaliativo adotado</th>
              <th class=\"text-center\">Ferram ou Técnica</th>
              <th class=\"text-center\">LT / LEO</th>
              <th class=\"text-center\">Nível de Ação</th>
              <th class=\"text-center\">Prob (P) / CE</th>
              <th class=\"text-center\">Sev (S) / AES</th>
              <th class=\"text-center\" style='width: 4%'>Class. de Risco</th>
            </tr>
            </thead>
            <tbody>";
		
		// Gerar linhas do Inventário de Risco
		$number = 0;
		foreach ($dangers as $danger):
			$probability = 0;
			
			if ($danger->getDanger()->getId() == 1) {
				$tool = $this->em->getRepository(Tool01::class)->findOneBy(['danger' => $danger]);
				if (!$tool) throw new \Exception('Existem perigos que não foram avaliados!');
				$probability = 0;
			} elseif ($danger->getDanger()->getId() == 2) {
				$tool = $this->em->getRepository(Tool02::class)->findOneBy(['danger' => $danger]);
				if (!$tool) throw new \Exception('Existem perigos que não foram avaliados!');
				if ($tool->getAverage() <= 20) {
					$probability = 0;
				} elseif ($tool->getAverage() > 20 && $tool->getAverage() <= 40) {
					$probability = 1;
				} elseif ($tool->getAverage() > 40 && $tool->getAverage() <= 60) {
					$probability = 2;
				} elseif ($tool->getAverage() > 60 && $tool->getAverage() <= 80) {
					$probability = 3;
				} elseif ($tool->getAverage() > 80 && $tool->getAverage() <= 100) {
					$probability = 4;
				}
			} elseif ($danger->getDanger()->getId() == 3) {
				$tool = $this->em->getRepository(Tool03::class)->findOneBy(['danger' => $danger]);
				if (!$tool) throw new \Exception('Existem perigos que não foram avaliados!');
				if ($tool->getResultDemand() < 15 && $tool->getResultControl() > 17) {
					$probability = 0;
				} elseif ($tool->getResultDemand() > 14 && $tool->getResultControl() > 17) {
					$probability = 1;
				} elseif ($tool->getResultDemand() < 15 && $tool->getResultControl() <= 17) {
					$probability = 2;
				} elseif ($tool->getResultDemand() > 14 && $tool->getResultControl() <= 17) {
					$probability = 4;
				}
				if ($tool->getResultSocialSupport() < 18) {
					$probability += 1;
				}
			} elseif ($danger->getDanger()->getId() == 4) {
				$tool = $this->em->getRepository(Tool04::class)->findOneBy(['danger' => $danger]);
				if (!$tool) throw new \Exception('Existem perigos que não foram avaliados!');
				$probability = $tool->isResultTotal();
			} elseif ($danger->getDanger()->getId() == 5) {
				$tool = $this->em->getRepository(Tool05::class)->findOneBy(['danger' => $danger]);
				if (!$tool) throw new \Exception('Existem perigos que não foram avaliados!');
				$probability = $tool->isResultTotal();
			} elseif ($danger->getDanger()->getId() == 7) {
				$tool = $this->em->getRepository(Tool07::class)->findOneBy(['danger' => $danger]);
				if (!$tool) throw new \Exception('Existem perigos que não foram avaliados!');
				$probability = $tool->isResultTotal();
			}
			
			
			if ($probability > 0) {
				$number++;
				// Buscar GES vinculados ao Perigo
				$ges = $this->em->getRepository(DangerGes::class)->findBy(['company' => $companySelected, 'active' => 1, 'danger' => $danger]);
				//Converter GES para string
				$stringGes = "";
				$totalProfessionals = 0;
				foreach ($ges as $item) {
					$stringGes .= "{$item->getGes()->getName()};<br>";
					$totalProfessionals = $totalProfessionals + $item->getGes()->getMan() + $item->getGes()->getWoman();
				}
				
				// Determinar o valor de x baseado no número de empregados
				$x = 0;
				if ($totalProfessionals > 0 && $totalProfessionals < 3) {
					$x = 1;
				} elseif ($totalProfessionals > 2 && $totalProfessionals < 8) {
					$x = 2;
				} elseif ($totalProfessionals > 7 && $totalProfessionals < 16) {
					$x = 4;
				} elseif ($totalProfessionals > 15 && $totalProfessionals < 51) {
					$x = 8;
				} elseif ($totalProfessionals > 50) {
					$x = 12;
				}
				
				// Gerar valores das colunas Avaliação de Riscos
				$multi = $probability * $x * $danger->getRisk()->getSeverity(); // Trocar o 5 pelo valor da categoria da severidade
				$result = 0;
				$color = "black";
				$background = "";
				if ($multi == 1) {
					$result = "{$multi} - Trivial";
					$background = "#00B050";
				} elseif ($multi > 1 && $multi < 5) {
					$result = "{$multi} - Baixa";
					$background = "#92D050";
				} elseif ($multi > 5 && $multi < 9) {
					$result = "{$multi} - Moderada";
					$background = "#FFFF00";
				} elseif ($multi > 8 && $multi < 13) {
					$result = "{$multi} - Alta";
					$background = "#FFC000";
				} elseif ($multi > 13 &&  $multi < 37) {
					$result = "{$multi} - Muito Alta";
					$background = "#FF0000";
					$color = "white";
				} elseif ($multi > 36 &&  $multi < 97) {
					$result = "{$multi} - Grave";
					$background = "#984806";
					$color = "white";
				} elseif ($multi > 96) {
					$result = "{$multi} - Crítica";
					$background = "#000000";
					$color = "white";
				}
				
				$s = $danger->getRisk()->getSeverity() * $x;
				
				$html .= "
            <tr class=\"middle\">
		          <td class=\"text-center\">{$number}</td>
		          <td class=\"text-center\">{$danger->getDanger()->getName()}</td>
		          <td class=\"text-center\">{$danger->getProcess()->getName()}</td>
		          <td class=\"text-center\">{$danger->getEnvironment()->getName()}</td>
		          <td class=\"text-center\">{$danger->getSource()}</td>
		          <td class=\"text-center\">{$danger->getFrequencyStr()}</td>
		          <td class=\"text-center\">{$danger->getRisk()->getLesion()}</td>
		          <td class=\"text-center\">{$stringGes}</td>
		          <td class=\"text-center\">{$danger->getPrevention()}</td>
		          <td class=\"text-center\">{$danger->getRisk()->getName()}</td>
		          <td class=\"text-center\">{$danger->getRisk()->getIntensity()}</td>
		          <td class=\"text-center\">{$danger->getRisk()->getLegislation()}</td>
		          <td class=\"text-center\">{$danger->getRisk()->getEvaluativeCriterion()}</td>
		          <td class=\"text-center\">{$danger->getRisk()->getTool()}</td>
		          <td class=\"text-center\">{$danger->getRisk()->getLeo()}</td>
		          <td class=\"text-center\">{$danger->getRisk()->getActionLevel()}</td>
		          <td class=\"text-center\">{$probability}</td>
		          <td class=\"text-center\">{$danger->getRisk()->getSeverity()} x {$x} = {$s}</td>
		          <td class=\"text-center\" style='background: {$background}; color: {$color}'>{$result}</td>
            </tr>";
			}
		endforeach;
		
		$html .= "</table></body>";
		
		return $html;
	}
}
