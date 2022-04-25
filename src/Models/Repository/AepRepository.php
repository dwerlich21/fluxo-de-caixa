<?php

namespace App\Models\Repository;

use App\Models\Entities\Aep;
use Doctrine\ORM\EntityRepository;

class AepRepository extends EntityRepository
{
	public function save(Aep $entity): Aep
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
}