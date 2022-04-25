<?php

namespace App\Models\Repository;

use App\Models\Entities\DangerTool;
use Doctrine\ORM\EntityRepository;

class DangerToolRepository extends EntityRepository
{
	public function save(DangerTool $entity): DangerTool
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
}