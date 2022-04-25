<?php
	
	
	namespace App\Models\Repository;
	
	
	use App\Models\Entities\Company;
	use App\Models\Entities\Environment;
	use Doctrine\ORM\EntityRepository;
	
	class EnvironmentRepository extends EntityRepository
	{
		public function save(Environment $entity): Environment
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
				$where .= " AND environment.name LIKE :name";
			}
			return $where;
		}
		
		public function list(Array $filter, Company $company, $order, $seq, $limit = null, $offset = null): array
		{
			$params = [];
			$params[':company'] = $company->getId();
			$where = $this->generateWhere($filter, $params);
			$limitSql = $this->generateLimit($limit, $offset, $order, $seq);
			$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
			$sql = "SELECT environment.id, environment.name, environment.area, environment.active, environment.establishment
                FROM environment
                WHERE environment.company = :company {$where}
                {$limitSql}
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
		
		public function listTotal(Array $filter, Company $company): array
		{
			$params = [];
			$params[':company'] = $company->getId();
			$where = $this->generateWhere($filter, $params);
			$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
			$sql = "SELECT COUNT(environment.id) AS total
                FROM environment
                WHERE environment.company = :company {$where}
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
                FROM environment
                WHERE environment.company = :company AND environment.id = :id
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
	}
