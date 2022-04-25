<?php
	
	
	namespace App\Models\Repository;
	
	
	use App\Models\Entities\Tool05;
	use Doctrine\ORM\EntityRepository;
	
	class Tool05Repository extends EntityRepository
	{
		public function save(Tool05 $entity): Tool05
		{
			$this->getEntityManager()->persist($entity);
			$this->getEntityManager()->flush();
			return $entity;
		}
	}