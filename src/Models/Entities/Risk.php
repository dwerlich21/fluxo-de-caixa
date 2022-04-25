<?php

namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="risk")
 */
class Risk
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
	/**
	 * @ManyToOne(targetEntity="DangerErgonomic")
	 * @JoinColumn(name="dangerErgonomic", referencedColumnName="id")
	 * @var DangerErgonomic
	 */
	private DangerErgonomic $dangerErgonomic;
	
	/**
	 * @Column(type="string")
	 */
	private string $name;
	
	/**
	 * @Column(type="string")
	 */
	private string $lesion;
	
	/**
	 * @Column(type="string", options={"default" : "NR 17"})
	 */
	private string $legislation;
	
	/**
	 * @Column(type="string", options={"default" : "Qualitativo"})
	 */
	private string $evaluativeCriterion;
	
	/**
	 * @Column(type="string")
	 */
	private string $tool;
	
	/**
	 * @Column(type="string", options={"default" : "NA"})
	 */
	private string $leo;

	/**
	 * @Column(type="string", options={"default" : "NA"})
	 */
	private string $actionLevel;
	
	/**
	 * @Column(type="string", options={"default" : "NA"})
	 */
	private string $intensity;
	
	/**
	 * @Column(type="string", options={"default" : 1})
	 */
	private string $severity;
	
	/**
	 * @return int|null
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	public function getDangerErgonomic(): DangerErgonomic
	{
		return $this->dangerErgonomic;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getLesion(): string
	{
		return $this->lesion;
	}

	public function getLegislation(): string
	{
		return $this->legislation;
	}

	public function getEvaluativeCriterion(): string
	{
		return $this->evaluativeCriterion;
	}

	public function getTool(): string
	{
		return $this->tool;
	}

	public function getLeo(): string
	{
		return $this->leo;
	}

	public function getActionLevel(): string
	{
		return $this->actionLevel;
	}

	public function getIntensity(): string
	{
		return $this->intensity;
	}

	public function getSeverity(): string
	{
		return $this->severity;
	}
}