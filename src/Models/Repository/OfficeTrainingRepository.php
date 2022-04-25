<?php
	
	
	namespace App\Models\Repository;
	
	
	use App\Models\Entities\OfficeTraining;
	use Doctrine\ORM\EntityRepository;
	
	class OfficeTrainingRepository extends EntityRepository
	{
		public function save(OfficeTraining $entity): OfficeTraining
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
			$sql = "SELECT officeTraining.training
                FROM officeTraining
                WHERE officeTraining.office = :office
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
	}