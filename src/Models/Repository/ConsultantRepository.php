<?php
	
	
	namespace App\Models\Repository;
	
	
	use App\Models\Entities\Consultant;
	use Doctrine\ORM\EntityRepository;
	
	class ConsultantRepository extends EntityRepository
	{
		public function save(Consultant $entity): Consultant
		{
			$this->getEntityManager()->persist($entity);
			$this->getEntityManager()->flush();
			return $entity;
		}
	}