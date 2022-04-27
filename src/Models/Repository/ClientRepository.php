<?php

namespace App\Models\Repository;

use App\Models\Entities\Client;
use App\Models\Entities\Company;
use Doctrine\ORM\EntityRepository;

class ClientRepository extends EntityRepository
{
	public function save(Client $entity): Client
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
			$where .= " AND client.id = :id";
		}
		if ($filter['name']) {
			$name = $filter['name'];
			$params[':name'] = "%$name%";
			$where .= " AND client.name LIKE :name";
		}
		if ($filter['email']) {
			$email = $filter['email'];
			$params[':email'] = "%$email%";
			$where .= " AND client.email LIKE :email";
		}
		if ($filter['type']) {
			$params[':type'] = $filter['type'];
			$where .= " AND client.type = :type";
		}
		return $where;
	}
	
	public function list(array $filter, $limit = null, $offset = null): array
	{
		$params = [];
		$limitSql = $this->generateLimit($limit, $offset);
		$where = $this->generateWhere($filter, $params);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT client.id, users.name, users.email, users.active, client.phone, client.country
                FROM client
				JOIN users ON users.client = client.id
                WHERE users.type = 3 {$where}
                ORDER BY type ASC, name ASC {$limitSql}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function listTotal(array $filter): array
	{
		$params = [];
		$where = $this->generateWhere($filter, $params);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT COUNT(client.id) AS total
                FROM client
				JOIN users ON users.client = client.id
                WHERE users.type = 3  {$where}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetch(\PDO::FETCH_ASSOC);
	}
	
	public function data(array $filter): array
	{
		$params = [];
		$params[':id'] = $filter['id'];
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT client.*, users.name, users.email, users.active
				FROM client
				JOIN users ON users.client = client.id
                WHERE client.id = :id
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
}