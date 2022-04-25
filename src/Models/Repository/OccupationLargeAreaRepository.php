<?php
	
	
	namespace App\Models\Repository;
	
	
	use App\Models\Entities\OccupationLargeArea;
	use Doctrine\ORM\EntityRepository;
	
	class OccupationLargeAreaRepository extends EntityRepository
	{
		public function save(OccupationLargeArea $entity): OccupationLargeArea
		{
			$this->getEntityManager()->persist($entity);
			$this->getEntityManager()->flush();
			return $entity;
		}
	}