<?php

namespace App\Models\Entities;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="documentBase")
 * @ORM @Entity(repositoryClass="App\Models\Repository\DocumentBaseRepository")
 */
class DocumentBase
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
	/**
	 * @Column(type="integer")
	 */
	private int $type;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $presentation = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $legalService = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $objectiveGeneral = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $objectiveSpecific = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $technicalTerms = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $identifyDanger = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $assessRisk = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $classifyRisk = null;
	
	/**
	 * @Column(type="text")
	 */
	private string $scopeContext;
	
	/**
	 * @ManyToOne(targetEntity="Company")
	 * @JoinColumn(name="company", referencedColumnName="id", nullable=true)
	 */
	private ?Company $company = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $result = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $closure = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $bibliography = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $severity = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $probability = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $matrixRisk = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $control = null;
	

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getType(): int
	{
		return $this->type;
	}

	public function setType(int $type): DocumentBase
	{
		$this->type = $type;
		return $this;
	}

	public function getPresentation(): ?string
	{
		return $this->presentation;
	}

	public function setPresentation(?string $presentation): DocumentBase
	{
		$this->presentation = $presentation;
		return $this;
	}

	public function getLegalService(): ?string
	{
		return $this->legalService;
	}

	public function setLegalService(?string $legalService): DocumentBase
	{
		$this->legalService = $legalService;
		return $this;
	}

	public function getTechnicalTerms(): ?string
	{
		return $this->technicalTerms;
	}

	public function setTechnicalTerms(?string $technicalTerms): DocumentBase
	{
		$this->technicalTerms = $technicalTerms;
		return $this;
	}

	public function getCompany(): ?Company
	{
		return $this->company;
	}

	public function setCompany(?Company $company): DocumentBase
	{
		$this->company = $company;
		return $this;
	}

	public function getIdentifyDanger(): ?string
	{
		return $this->identifyDanger;
	}

	public function setIdentifyDanger(?string $identifyDanger): DocumentBase
	{
		$this->identifyDanger = $identifyDanger;
		return $this;
	}

	public function getAssessRisk(): ?string
	{
		return $this->assessRisk;
	}

	public function setAssessRisk(?string $assessRisk): DocumentBase
	{
		$this->assessRisk = $assessRisk;
		return $this;
	}

	public function getClassifyRisk(): ?string
	{
		return $this->classifyRisk;
	}

	public function setClassifyRisk(?string $classifyRisk): DocumentBase
	{
		$this->classifyRisk = $classifyRisk;
		return $this;
	}

	public function getResult(): ?string
	{
		return $this->result;
	}

	public function setResult(?string $result): DocumentBase
	{
		$this->result = $result;
		return $this;
	}

	public function getClosure(): ?string
	{
		return $this->closure;
	}

	public function setClosure(?string $closure): DocumentBase
	{
		$this->closure = $closure;
		return $this;
	}

	public function getBibliography(): ?string
	{
		return $this->bibliography;
	}

	public function setBibliography(?string $bibliography): DocumentBase
	{
		$this->bibliography = $bibliography;
		return $this;
	}

	public function getObjectiveGeneral(): ?string
	{
		return $this->objectiveGeneral;
	}

	public function setObjectiveGeneral(?string $objectiveGeneral): DocumentBase
	{
		$this->objectiveGeneral = $objectiveGeneral;
		return $this;
	}

	public function getObjectiveSpecific(): ?string
	{
		return $this->objectiveSpecific;
	}

	public function setObjectiveSpecific(?string $objectiveSpecific): DocumentBase
	{
		$this->objectiveSpecific = $objectiveSpecific;
		return $this;
	}

	public function getSeverity(): ?string
	{
		return $this->severity;
	}

	public function setSeverity(?string $severity): DocumentBase
	{
		$this->severity = $severity;
		return $this;
	}

	public function getProbability(): ?string
	{
		return $this->probability;
	}

	public function setProbability(?string $probability): DocumentBase
	{
		$this->probability = $probability;
		return $this;
	}

	public function getScopeContext(): string
	{
		return $this->scopeContext;
	}

	public function setScopeContext(string $scopeContext): DocumentBase
	{
		$this->scopeContext = $scopeContext;
		return $this;
	}

	public function getMatrixRisk(): ?string
	{
		return $this->matrixRisk;
	}

	public function setMatrixRisk(?string $matrixRisk): DocumentBase
	{
		$this->matrixRisk = $matrixRisk;
		return $this;
	}

	public function getControl(): ?string
	{
		return $this->control;
	}

	public function setControl(?string $control): DocumentBase
	{
		$this->control = $control;
		return $this;
	}
}