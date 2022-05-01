<?php

namespace App\Models\Repository;

use App\Models\Entities\Account;
use Doctrine\ORM\EntityRepository;

class AccountRepository extends EntityRepository
{
	public function save(Account $entity): Account
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
			$where .= " AND account.id = :id";
		}
		return $where;
	}
	
	public function list(array $filter, $limit = null, $offset = null): array
	{
		$params = [];
		$limitSql = $this->generateLimit($limit, $offset);
		$where = $this->generateWhere($filter, $params);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT *
                FROM account
                WHERE 1 = 1 {$where}
                ORDER BY name ASC {$limitSql}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function listTotal(): array
	{
		$params = [];
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT COUNT(account.id) AS total
                FROM account
				WHERE 1 = 1
               ";;
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetch(\PDO::FETCH_ASSOC);
	}
}