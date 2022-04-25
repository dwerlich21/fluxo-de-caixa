<?php
	
	
	namespace App\Models\Repository;
	
	
	use App\Models\Entities\PaymentPlan;
	use Doctrine\ORM\EntityRepository;
	
	class PaymentPlanRepository extends EntityRepository
	{
		public function save(PaymentPlan $entity): PaymentPlan
		{
			$this->getEntityManager()->persist($entity);
			$this->getEntityManager()->flush();
			return $entity;
		}
	}