<?php


namespace App\Models\Repository;


use App\Models\Entities\Danger;
use App\Models\Entities\Tool03Professional;
use Doctrine\ORM\EntityRepository;

class Tool03ProfessionalRepository extends EntityRepository
{
	public function save(Tool03Professional $entity): Tool03Professional
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
	
	public function average(Danger $danger): array
	{
		$params = [];
		$params[':danger'] = $danger->getId();
		$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
		$sql = "SELECT COUNT(tool03Professional.id) AS total, SUM(tool03Professional.resultDemand) AS resultDemand,
       			SUM(tool03Professional.resultSocialSupport) AS resultSocialSupport, SUM(tool03Professional.resultControl) AS resultControl
                FROM tool03Professional
                WHERE tool03Professional.danger = :danger
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
}