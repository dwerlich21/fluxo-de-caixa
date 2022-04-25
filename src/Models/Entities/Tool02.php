<?php

namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
/**
 * @Entity @Table(name="tool02")
 * @ORM @Entity(repositoryClass="App\Models\Repository\Tool02Repository")
 */
class Tool02
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
	 * @Column(type="float")
	 */
	private float $average;
	

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getCompany(): Company
	{
		return $this->company;
	}

	public function setCompany(Company $company): Tool02
	{
		$this->company = $company;
		return $this;
	}

	public function getDanger(): Danger
	{
		return $this->danger;
	}

	public function setDanger(Danger $danger): Tool02
	{
		$this->danger = $danger;
		return $this;
	}

	public function getAverage(): float
	{
		return $this->average;
	}

	public function setAverage(float $average): Tool02
	{
		$this->average = $average;
		return $this;
	}
}