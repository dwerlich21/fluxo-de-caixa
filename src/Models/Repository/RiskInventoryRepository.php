<?php

namespace App\Models\Repository;

use App\Models\Entities\Company;
use App\Models\Entities\RiskInventory;
use Doctrine\ORM\EntityRepository;

class RiskInventoryRepository extends EntityRepository
{
	public function save(RiskInventory $entity): RiskInventory
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
	
	private function generateWhere($filter, &$params): string
	{
		$where = '';
		if ($filter['ges'] != 0 && $filter['ges'] != 'undefined') {
			$params[':ges'] = $filter['ges'];
			$where .= " AND dangerGes.ges = :ges AND dangerGes.active = 1";
		}
		if ($filter['danger'] != 0 && $filter['danger'] != 'undefined') {
			$params[':danger'] = $filter['danger'];
			$where .= " AND danger.danger = :danger";
		}
		return $where;
	}
	
	private function generateLimit($limit = null, $offset = null, $order = null, $seq = null): string
	{
		$limitSql = '';
		if ($limit) {
			$limit = (int)$limit;
			$offset = (int)$offset;
			$limitSql = "ORDER BY {$order} {$seq} LIMIT {$limit} OFFSET {$offset}";
		}
		return $limitSql;
	}
	
	public function list(array $filter, Company $company, $order, $seq, $limit = null, $offset = null): array
	{
		$params = [];
		$params[':company'] = $company->getId();
		$where = $this->generateWhere($filter, $params);
		$limitSql = $this->generateLimit($limit, $offset, $order, $seq);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT riskInventory.id, DATE_FORMAT(riskInventory.created, '%d/%m/%Y') AS created, users.name AS responsible,
				riskInventory.title
                FROM riskInventory
				JOIN users ON users.id = riskInventory.responsible
                WHERE riskInventory.company = :company AND riskInventory.status = 1 AND riskInventory.type = 1 {$where}
                 {$limitSql}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function listTotal(array $filter, Company $company): array
	{
		$params = [];
		$params[':company'] = $company->getId();
		$where = $this->generateWhere($filter, $params);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT COUNT(DISTINCT(riskInventory.id)) AS total
                FROM riskInventory
                WHERE riskInventory.company = :company AND riskInventory.status = 1 AND riskInventory.type = 1 {$where}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetch(\PDO::FETCH_ASSOC);
	}
}