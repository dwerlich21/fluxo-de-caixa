<?php
	
	
	namespace App\Models\Repository;
	
	
	use App\Models\Entities\CnaeSecondary;
	use App\Models\Entities\Company;
	use Doctrine\ORM\EntityRepository;
	
	class CnaeSecondaryRepository extends EntityRepository
	{
		public function save(CnaeSecondary $entity): CnaeSecondary
		{
			$this->getEntityManager()->persist($entity);
			$this->getEntityManager()->flush();
			return $entity;
		}
	}