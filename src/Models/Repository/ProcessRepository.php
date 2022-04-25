<?php


namespace App\Models\Repository;


use App\Models\Entities\Company;
use App\Models\Entities\Process;
use Doctrine\ORM\EntityRepository;

class ProcessRepository extends EntityRepository
{
	public function save(Process $entity): Process
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
	
	private function generateWhere($filter, &$params): string
	{
		$where = '';
		if ($filter['name']) {
			$name = $filter['name'];
			$params[':name'] = "%$name%";
			$where .= " AND process.name LIKE :name";
		}
		return $where;
	}
	
	public function list(array $filter, Company $company, $order, $seq, $limit = null, $offset = null): array
	{
		$params = [];
		$params[':company'] = $company->getId();
		$where = $this->generateWhere($filter, $params);
		$limitSql = $this->generateLimit($limit, $offset, $order, $seq);
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT process.id, process.name, process.description, process.active
                FROM process
                WHERE process.company = :company {$where}
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
		$sql = "SELECT COUNT(process.id) AS total
                FROM process
                WHERE process.company = :company {$where}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetch(\PDO::FETCH_ASSOC);
	}
	
	public function data($id = null, Company $company): array
	{
		$params = [];
		$params[':company'] = $company->getId();
		$params[':id'] = $id;
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT process.id, process.name, process.description, process.active
                FROM process
                WHERE process.company = :company AND process.id = :id
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
}