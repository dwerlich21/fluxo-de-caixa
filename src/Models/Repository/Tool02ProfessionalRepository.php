<?php


namespace App\Models\Repository;


use App\Models\Entities\Company;
use App\Models\Entities\Danger;
use App\Models\Entities\Tool02Professional;
use Doctrine\ORM\EntityRepository;

class Tool02ProfessionalRepository extends EntityRepository
{
	public function save(Tool02Professional $entity): Tool02Professional
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
		$sql = "SELECT COUNT(tool02Professional.id) AS total, SUM(tool02Professional.result) AS addition
                FROM tool02Professional
                WHERE tool02Professional.danger = :danger
               ";
		$sth = $pdo->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
}