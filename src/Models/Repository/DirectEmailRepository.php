<?php


namespace App\Models\Repository;


use App\Models\Entities\Company;
use App\Models\Entities\Danger;
use App\Models\Entities\DirectEmail;
use Doctrine\ORM\EntityRepository;

class DirectEmailRepository extends EntityRepository
{
	public function save(DirectEmail $entity): DirectEmail
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
	
	private function generateLimit($limit = null, $offset = null): string
	{
		$limitSql = '';
		if ($limit) {
			$limit = (int)$limit;
			$offset = (int)$offset;
			$limitSql = "LIMIT {$limit} OFFSET {$offset}";
		}
		return $limitSql;
	}
	
	public function listTool01(Company $company, Danger $danger, $tool, $limit = null, $offset = null): array
	{
		$params = [];
		$params[':danger'] = $danger->getId();
		$params[':company'] = $company->getId();
		$params[':tool'] = $tool;
		$limitSql = $this->generateLimit($limit, $offset);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT directEmail.id, directEmail.email, directEmail.professional, directEmail.token, directEmail.tool
				FROM directEmail
                WHERE directEmail.company = :company AND directEmail.danger = :danger AND directEmail.tool = :tool
                ORDER BY professional ASC {$limitSql}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function listTool02(Company $company, Danger $danger, $tool, $limit = null, $offset = null): array
	{
		$params = [];
		$params[':danger'] = $danger->getId();
		$params[':company'] = $company->getId();
		$params[':tool'] = $tool;
		$limitSql = $this->generateLimit($limit, $offset);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT directEmail.id, directEmail.email, directEmail.professional, directEmail.token, directEmail.tool,
       			tool02Professional.id AS toolId, tool02Professional.result AS result
				FROM directEmail
				LEFT JOIN tool02Professional ON tool02Professional.directEmail = directEmail.id
                WHERE directEmail.company = :company AND directEmail.danger = :danger AND directEmail.tool = :tool
                ORDER BY directEmail.professional ASC {$limitSql}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function listTool03(Company $company, Danger $danger, $tool, $limit = null, $offset = null): array
	{
		$params = [];
		$params[':danger'] = $danger->getId();
		$params[':company'] = $company->getId();
		$params[':tool'] = $tool;
		$limitSql = $this->generateLimit($limit, $offset);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT directEmail.id, directEmail.email, directEmail.professional, directEmail.token, directEmail.tool,
       			tool03Professional.id AS toolId, tool03Professional.resultSocialSupport AS resultSocialSupport,
       			tool03Professional.resultControl AS resultControl, tool03Professional.resultDemand AS resultDemand
				FROM directEmail
				LEFT JOIN tool03Professional ON tool03Professional.directEmail = directEmail.id
                WHERE directEmail.company = :company AND directEmail.danger = :danger AND directEmail.tool = :tool
                ORDER BY directEmail.professional ASC {$limitSql}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function listTotal(Company $company, Danger $danger, $tool): array
	{
		$params = [];
		$params[':danger'] = $danger->getId();
		$params[':company'] = $company->getId();
		$params[':tool'] = $tool;
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT COUNT(directEmail.id) AS total
                FROM directEmail
                WHERE directEmail.company = :company AND directEmail.danger = :danger AND directEmail.tool = :tool
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetch(\PDO::FETCH_ASSOC);
	}
}