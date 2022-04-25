<?php

namespace App\Models\Repository;

use App\Models\Entities\Company;
use App\Models\Entities\Equipament;
use Doctrine\ORM\EntityRepository;

class EquipamentRepository extends EntityRepository
{
	public function save(Equipament $entity): Equipament
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
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
	
	private function generateWhere($id = null, array $filter, &$params): string
	{
		$where = '';
		if ($id) {
			$params[':id'] = $id;
			$where .= " AND equipament.id = :id";
		}
		if ($filter['name']) {
			$name = $filter['name'];
			$params[':name'] = "%$name%";
			$where .= " AND equipament.name LIKE :name";
		}
		return $where;
	}
	
	public function list($id = null, array $filter, Company $company, $order, $seq, $limit = null, $offset = null): array
	{
		$params = [];
		$params[':consultant'] = $company->getConsultant()->getId();
		$where = $this->generateWhere($id, $filter, $params);
		$limitSql = $this->generateLimit($limit, $offset, $order, $seq);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT *, DATE_FORMAT(equipament.date, '%d/%m/%Y') as date, DATE_FORMAT(equipament.validity, '%d/%m/%Y') as validity
                FROM equipament
                WHERE equipament.consultant = :consultant {$where}
                {$limitSql}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function listTotal($id = null, array $filter, Company $company): array
	{
		$params = [];
		$params[':consultant'] = $company->getConsultant()->getId();
		$where = $this->generateWhere($id, $filter, $params);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT COUNT(equipament.id) AS total
                FROM equipament
                WHERE equipament.consultant = :consultant {$where}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetch(\PDO::FETCH_ASSOC);
	}
}