<?php
	
	
	namespace App\Models\Repository;
	
	use App\Models\Entities\Company;
	use App\Models\Entities\Office;
	use Doctrine\ORM\EntityRepository;
	
	class OfficeRepository extends EntityRepository
	{
		public function save(Office $entity): Office
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
			if ($filter['office']) {
				$office = $filter['office'];
				$params[':name'] = "%$office%";
				$where .= " AND office.name LIKE :name";
			}
			if ($filter['occupation']) {
				$occupation = $filter['occupation'];
				$params[':occupation'] = "%$occupation%";
				$where .= " AND office.occupation LIKE :occupation";
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
			$sql = "SELECT office.id, office.name, office.active, occupation.occupation AS occupationName
				FROM office
				JOIN occupation ON occupation.id = office.occupation
                WHERE office.company = :company {$where}
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
			$sql = "SELECT COUNT(office.id) AS total
                FROM office
                WHERE office.company = :company {$where}
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
			$sql = "SELECT office.id, office.responsible, office.company, office.name, office.active, office.scalesOuter, office.environment,
					office.scales, office.occupation, occupation.occupation AS occupationName, office.weekday, office.dailyJourney
				FROM office
				JOIN occupation ON occupation.id = office.occupation
                WHERE office.company = :company AND office.id = :id
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
	}
