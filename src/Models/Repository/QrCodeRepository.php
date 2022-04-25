<?php

namespace App\Models\Repository;

use App\Models\Entities\QrCode;
use Doctrine\ORM\EntityRepository;

class QrCodeRepository extends EntityRepository
{
	public function save(QrCode $entity): QrCode
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
}