<?php
	
	
	namespace App\Models\Repository;
	
	
	use App\Models\Entities\Tool04;
	use Doctrine\ORM\EntityRepository;
	
	class Tool04Repository extends EntityRepository
	{
		public function save(Tool04 $entity): Tool04
		{
			$this->getEntityManager()->persist($entity);
			$this->getEntityManager()->flush();
			return $entity;
		}
	}