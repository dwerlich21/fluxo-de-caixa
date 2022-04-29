<?php

namespace App\Models\Repository;

use App\Models\Entities\Financial;
use Doctrine\ORM\EntityRepository;

class FinancialRepository extends EntityRepository
{
	public function save(Financial $entity): Financial
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
			$limitSql = " LIMIT {$limit} OFFSET {$offset}";
		}
		return $limitSql;
	}
	
	private function generateWhere(array $filter, &$params): string
	{
		$where = '';
		if ($filter['id']) {
			$params[':id'] = $filter['id'];
			$where .= " AND financial.id = :id";
		}
		if ($filter['client']) {
			$params[':client'] = $filter['client'];
			$where .= " AND financial.client = :client";
		}
		if ($filter['destiny']) {
			$params[':destiny'] = $filter['destiny'];
			$where .= " AND financial.destiny = :destiny";
		}
		if ($filter['code']) {
			$code = $filter['code'];
			$params[':code'] = "%$code%";
			$where .= " AND financial.code LIKE :code";
		}
		return $where;
	}
	
	public function list(array $filter, $type, $limit = null, $offset = null): array
	{
		$params = [];
		$params[':type'] = $type;
		$limitSql = $this->generateLimit($limit, $offset);
		$where = $this->generateWhere($filter, $params);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT financial.*, DATE_FORMAT(financial.date, '%d/%m/%Y') as dateList, users.name AS name
                FROM financial
				JOIN client ON client.id = financial.client
				JOIN users ON users.client = client.id
                WHERE financial.type = :type {$where}
                ORDER BY date desc {$limitSql}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function listTotal(array $filter, $type): array
	{
		$params = [];
		$params[':type'] = $type;
		$where = $this->generateWhere($filter, $params);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT COUNT(financial.id) AS total
                FROM financial
				JOIN client ON client.id = financial.client
				JOIN users ON users.client = client.id
                WHERE financial.type = :type  {$where}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetch(\PDO::FETCH_ASSOC);
	}
}