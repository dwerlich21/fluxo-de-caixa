<?php

namespace App\Models\Entities;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="aep")
 * @ORM @Entity(repositoryClass="App\Models\Repository\AepRepository")
 */
class Aep
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
	/**
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(name="responsible", referencedColumnName="id")
	 * @var User
	 */
	private User $responsible;
	
	/**
	 * @ManyToOne(targetEntity="Company")
	 * @JoinColumn(name="company", referencedColumnName="id")
	 * @var Company
	 */
	private Company $company;
	
	/**
	 * @Column(type="text")
	 */
	private string $version;
	
	/**
	 * @Column(type="text")
	 */
	private string $approver;
	
	/**
	 * @Column(type="date")
	 */
	private \DateTime $date;
	
	/**
	 * @Column(type="text")
	 */
	private string $description;
	
	/**
	 * @Column(type="text")
	 */
	private string $header;
	
	/**
	 * @Column(type="text")
	 */
	private string $footer;
	
	/**
	 * @Column(type="text")
	 */
	private string $frontCover;
	
	/**
	 * @Column(type="text")
	 */
	private string $reviews;
	
	/**
	 * @Column(type="text")
	 */
	private string $presentation;
	
	/**
	 * @Column(type="text")
	 */
	private string $presentationPdf;
	
	/**
	 * @Column(type="text")
	 */
	private string $summary;
	
	/**
	 * @Column(type="text")
	 */
	private string $companyDetails;
	
	/**
	 * @Column(type="text")
	 */
	private string $scopeContext;
	
	/**
	 * @ManyToOne(targetEntity="RiskInventory")
	 * @JoinColumn(name="riskInventory", referencedColumnName="id")
	 * @var RiskInventory
	 */
	private RiskInventory $riskInventory;
	

	
	public function getId(): ?int
	{
		return $this->id;
	}

	public function getResponsible(): User
	{
		return $this->responsible;
	}

	public function setResponsible(User $responsible): Aep
	{
		$this->responsible = $responsible;
		return $this;
	}

	public function getCompany(): Company
	{
		return $this->company;
	}

	public function setCompany(Company $company): Aep
	{
		$this->company = $company;
		return $this;
	}

	public function getVersion(): string
	{
		return $this->version;
	}

	public function setVersion(string $version): Aep
	{
		$this->version = $version;
		return $this;
	}

	public function getApprover(): string
	{
		return $this->approver;
	}

	public function setApprover(string $approver): Aep
	{
		$this->approver = $approver;
		return $this;
	}

	public function getDate(): \DateTime
	{
		return $this->date;
	}

	public function setDate(\DateTime $date): Aep
	{
		$this->date = $date;
		return $this;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function setDescription(string $description): Aep
	{
		$this->description = $description;
		return $this;
	}

	public function getHeader(): string
	{
		return $this->header;
	}

	public function setHeader(string $header): Aep
	{
		$this->header = $header;
		return $this;
	}

	public function getFooter(): string
	{
		return $this->footer;
	}

	public function setFooter(string $footer): Aep
	{
		$this->footer = $footer;
		return $this;
	}

	public function getFrontCover(): string
	{
		return $this->frontCover;
	}

	public function setFrontCover(string $frontCover): Aep
	{
		$this->frontCover = $frontCover;
		return $this;
	}

	public function getReviews(): string
	{
		return $this->reviews;
	}

	public function setReviews(string $reviews): Aep
	{
		$this->reviews = $reviews;
		return $this;
	}

	public function getPresentation(): string
	{
		return $this->presentation;
	}

	public function setPresentation(string $presentation): Aep
	{
		$this->presentation = $presentation;
		return $this;
	}

	public function getSummary(): string
	{
		return $this->summary;
	}

	public function setSummary(string $summary): Aep
	{
		$this->summary = $summary;
		return $this;
	}

	public function getCompanyDetails(): string
	{
		return $this->companyDetails;
	}

	public function setCompanyDetails(string $companyDetails): Aep
	{
		$this->companyDetails = $companyDetails;
		return $this;
	}

	public function getPresentationPdf(): string
	{
		return $this->presentationPdf;
	}

	public function setPresentationPdf(string $presentationPdf): Aep
	{
		$this->presentationPdf = $presentationPdf;
		return $this;
	}

	public function getRiskInventory(): RiskInventory
	{
		return $this->riskInventory;
	}

	public function setRiskInventory(RiskInventory $riskInventory): Aep
	{
		$this->riskInventory = $riskInventory;
		return $this;
	}

	public function getScopeContext(): string
	{
		return $this->scopeContext;
	}

	public function setScopeContext(string $scopeContext): Aep
	{
		$this->scopeContext = $scopeContext;
		return $this;
	}
}