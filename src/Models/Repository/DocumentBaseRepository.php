<?php

namespace App\Models\Repository;

use App\Models\Entities\DocumentBase;
use Doctrine\ORM\EntityRepository;

class DocumentBaseRepository extends EntityRepository
{
	public function save(DocumentBase $entity): DocumentBase
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
}