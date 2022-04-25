<?php
	
	
	namespace App\Models\Repository;
	
	
	use App\Models\Entities\DangerGes;
	use Doctrine\ORM\EntityRepository;
	
	class DangerGesRepository extends EntityRepository
	{
		public function save(DangerGes $entity): DangerGes
		{
			$this->getEntityManager()->persist($entity);
			$this->getEntityManager()->flush();
			return $entity;
		}
	}