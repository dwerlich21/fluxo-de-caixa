<?php


namespace App\Models\Repository;


use App\Models\Entities\Company;
use Doctrine\ORM\EntityRepository;

class CompanyRepository extends EntityRepository
{
	public function save(Company $entity): Company
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
}
