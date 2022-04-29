<?php

namespace App\Models\Repository;

use App\Models\Entities\Financial;
use Doctrine\ORM\EntityRepository;

class FinancialRepository extends EntityRepository
{
	public function save(Financial $entity): Financial
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
}