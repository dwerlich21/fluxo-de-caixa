<?php
	
	
	namespace App\Models\Repository;
	
	
	use App\Models\Entities\Environment;
	use App\Models\Entities\EnvironmentLightSource;
	use Doctrine\ORM\EntityRepository;
	
	class EnvironmentLightSourceRepository extends EntityRepository
	{
		public function save(EnvironmentLightSource $entity): EnvironmentLightSource
		{
			$this->getEntityManager()->persist($entity);
			$this->getEntityManager()->flush();
			return $entity;
		}
	}