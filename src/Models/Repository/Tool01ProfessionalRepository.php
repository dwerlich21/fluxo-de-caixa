<?php


namespace App\Models\Repository;


use App\Models\Entities\Tool01Professional;
use Doctrine\ORM\EntityRepository;

class Tool01ProfessionalRepository extends EntityRepository
{
	public function save(Tool01Professional $entity): Tool01Professional
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
}