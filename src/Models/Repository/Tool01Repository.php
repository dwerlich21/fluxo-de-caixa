<?php


namespace App\Models\Repository;


use App\Models\Entities\Tool01;
use Doctrine\ORM\EntityRepository;

class Tool01Repository extends EntityRepository
{
	public function save(Tool01 $entity): Tool01
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
}