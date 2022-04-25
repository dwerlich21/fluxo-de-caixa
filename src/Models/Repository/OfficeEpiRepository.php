<?php
	
	
	namespace App\Models\Repository;
	
	
	use App\Models\Entities\OfficeEpi;
	use Doctrine\ORM\EntityRepository;
	
	class OfficeEpiRepository extends EntityRepository
	{
		public function save(OfficeEpi $entity): OfficeEpi
		{
			$this->getEntityManager()->persist($entity);
			$this->getEntityManager()->flush();
			return $entity;
		}
		
		public function list($office): array
		{
			$params = [];
			$params[':office'] = $office;
			$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
			$sql = "SELECT officeEpi.epi
                FROM officeEpi
                WHERE officeEpi.office = :office
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
	}