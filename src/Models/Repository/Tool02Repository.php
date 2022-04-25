<?php

namespace App\Models\Repository;

use App\Models\Entities\Tool02;
use Doctrine\ORM\EntityRepository;

class Tool02Repository extends EntityRepository
{
	public function save(Tool02 $entity): Tool02
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
}