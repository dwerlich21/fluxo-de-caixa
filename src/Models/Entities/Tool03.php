<?php

namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
/**
 * @Entity @Table(name="tool03")
 * @ORM @Entity(repositoryClass="App\Models\Repository\Tool03Repository")
 */
class Tool03
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
	/**
	 * @ManyToOne(targetEntity="Company")
	 * @JoinColumn(name="company", referencedColumnName="id")
	 * @var Company
	 */
	private Company $company;
	
	/**
	 * @ManyToOne(targetEntity="Danger")
	 * @JoinColumn(name="danger", referencedColumnName="id")
	 * @var Danger
	 */
	private Danger $danger;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $resultDemand;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $resultControl;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $resultSocialSupport;
	

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getCompany(): Company
	{
		return $this->company;
	}

	public function setCompany(Company $company): Tool03
	{
		$this->company = $company;
		return $this;
	}

	public function getDanger(): Danger
	{
		return $this->danger;
	}

	public function setDanger(Danger $danger): Tool03
	{
		$this->danger = $danger;
		return $this;
	}

	public function getResultDemand(): int
	{
		return $this->resultDemand;
	}

	public function setResultDemand(int $resultDemand): Tool03
	{
		$this->resultDemand = $resultDemand;
		return $this;
	}

	public function getResultControl(): int
	{
		return $this->resultControl;
	}

	public function setResultControl(int $resultControl): Tool03
	{
		$this->resultControl = $resultControl;
		return $this;
	}

	public function getResultSocialSupport(): int
	{
		return $this->resultSocialSupport;
	}

	public function setResultSocialSupport(int $resultSocialSupport): Tool03
	{
		$this->resultSocialSupport = $resultSocialSupport;
		return $this;
	}
}