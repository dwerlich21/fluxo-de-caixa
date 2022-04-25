<?php
	
	
	namespace App\Models\Repository;
	
	use App\Models\Entities\OfficeActivity;
	use App\Models\Entities\Office;
	use Doctrine\ORM\EntityRepository;
	
	class OfficeActivityRepository extends EntityRepository
	{
		public function save(OfficeActivity $entity): OfficeActivity
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
			$sql = "SELECT officeActivity.activity
                FROM officeActivity
                WHERE officeActivity.office = :office
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
	}
