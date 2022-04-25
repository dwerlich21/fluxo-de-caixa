<?php
	
	
	namespace App\Models\Repository;
	
	
	use App\Models\Entities\Company;
	use App\Models\Entities\Professional;
	use Doctrine\ORM\EntityRepository;
	
	class ProfessionalRepository extends EntityRepository
	{
		public function save(Professional $entity): Professional
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
				$where .= " AND professional.name LIKE :name";
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
			$sql = "SELECT professional.formation, professional.admission AS admissionOrder,
                DATE_FORMAT(professional.admission, '%d/%m/%Y') AS admission,
                professional.name, office.name AS office
                FROM professional
                JOIN office ON office.id = professional.office
                WHERE professional.company = :company {$where}
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
			$sql = "SELECT COUNT(professional.id) AS total
                FROM professional
                WHERE professional.company = :company {$where}
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetch(\PDO::FETCH_ASSOC);
		}
		
		public function data(int $id,  Company $company): array
		{
			$params = [];
			$params[':company'] = $company->getId();
			$params[':id'] = $id;
			$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
			$sql = "SELECT professional.formation, professional.professionalRecord, professional.professionalRegistration, professional.office,
                DATE_FORMAT(professional.admission, '%d/%m/%Y') AS admission, DATE_FORMAT(professional.resignation, '%d/%m/%Y') AS resignation,
                professional.id, DATE_FORMAT(professional.birthDate, '%d/%m/%Y') AS birthDate, professional.professionalAdviser, professional.cpf,
                professional.sex, professional.name, office.name AS office, office.id AS officeId, professional.environment,
                professional.endInOffice, professional.startInOffice
                FROM professional
                JOIN office ON office.id = professional.office
                WHERE professional.company = :company AND professional.id = :id
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
		
		public function changeStatus($id): array
		{
			$params = [];
			$params[':company'] = $id;
			$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
			$sql = "SELECT professional.user
                FROM professional
                WHERE professional.company = :company
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
	}
