<?php


namespace App\Models\Repository;


use App\Models\Entities\Tool07;
use Doctrine\ORM\EntityRepository;

class Tool07Repository extends EntityRepository
{
	public function save(Tool07 $entity): Tool07
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
}