<?php


namespace App\Models\Repository;


use App\Models\Entities\Company;
use App\Models\Entities\Danger;
use Doctrine\ORM\EntityRepository;

class DangerRepository extends EntityRepository
{
	public function save(Danger $entity): Danger
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
		$sql = "SELECT DISTINCT(danger.id), danger.id, environment.name AS environment,  danger.source, dangerErgonomic.name AS danger,
					danger.frequency, danger.prevention, process.name AS process
                FROM danger
                JOIN environment ON environment.id = danger.environment
                JOIN dangerErgonomic ON dangerErgonomic.id = danger.danger
                JOIN process ON process.id = danger.process
                JOIN dangerGes ON dangerGes.danger = danger.id
                WHERE danger.company = :company AND danger.status = 1 {$where}
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
		$sql = "SELECT COUNT(DISTINCT(danger.id)) AS total
                FROM danger
                JOIN dangerGes ON dangerGes.danger = danger.id
                WHERE danger.company = :company AND danger.status = 1 {$where}
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetch(\PDO::FETCH_ASSOC);
	}
	
	public function data(int $id, Company $company): array
	{
		$params = [];
		$params[':company'] = $company->getId();
		$params[':id'] = $id;
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT *
                FROM danger
                WHERE danger.company = :company AND danger.id = :id
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
}
