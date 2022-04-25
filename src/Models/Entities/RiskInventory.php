<?php

namespace App\Models\Entities;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="riskInventory")
 * @ORM @Entity(repositoryClass="App\Models\Repository\RiskInventoryRepository")
 */
class RiskInventory
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
	 * @Column(type="string")
	 */
	private string $title;
	
	/**
	 * @Column(type="text")
	 */
	private string $riskInventory;
	
	/**
	 * @Column(type="integer")
	 */
	private int $type;
	
	/**
	 * @Column(type="datetime")
	 */
	private \DateTime $created;
	
	/**
	 * @Column(type="boolean")
	 */
	private bool $status;
	
	public function __construct()
	{
		$this->created = new \DateTime();
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getResponsible(): User
	{
		return $this->responsible;
	}

	public function setResponsible(User $responsible): RiskInventory
	{
		$this->responsible = $responsible;
		return $this;
	}

	public function getCompany(): Company
	{
		return $this->company;
	}

	public function setCompany(Company $company): RiskInventory
	{
		$this->company = $company;
		return $this;
	}

	public function getRiskInventory(): string
	{
		return $this->riskInventory;
	}

	public function setRiskInventory(string $riskInventory): RiskInventory
	{
		$this->riskInventory = $riskInventory;
		return $this;
	}

	public function getType(): int
	{
		return $this->type;
	}

	public function setType(int $type): RiskInventory
	{
		$this->type = $type;
		return $this;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function setTitle(string $title): RiskInventory
	{
		$this->title = $title;
		return $this;
	}

	public function isStatus(): bool
	{
		return $this->status;
	}

	public function setStatus(bool $status): RiskInventory
	{
		$this->status = $status;
		return $this;
	}

	public function getCreated(): \DateTime
	{
		return $this->created;
	}
}