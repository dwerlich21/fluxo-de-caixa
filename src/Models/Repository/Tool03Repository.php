<?php

namespace App\Models\Repository;

use App\Models\Entities\Tool03;
use Doctrine\ORM\EntityRepository;

class Tool03Repository extends EntityRepository
{
	public function save(Tool03 $entity): Tool03
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
}