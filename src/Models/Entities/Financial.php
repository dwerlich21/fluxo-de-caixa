<?php

namespace App\Models\Entities;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="financial")
 * @ORM @Entity(repositoryClass="App\Models\Repository\FinancialRepository")
 */
class Financial
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
	/**
	 * @Column(type="boolean")
	 */
	private bool $type;
	
	/**
	 * @ManyToOne(targetEntity="Client")
	 * @JoinColumn(name="client", referencedColumnName="id", nullable=true)
	 * @var Client
	 */
	private Client $client;
	
	/**
	 * @ManyToOne(targetEntity="Account")
	 * @JoinColumn(name="account", referencedColumnName="id", nullable=true)
	 * @var Account|null
	 */
	private ?Account $account = null;
	
	/**
	 * @Column(type="float", nullable=true)
	 */
	private ?float $valueReal = null;
	
	/**
	 * @Column(type="float")
	 */
	private float $valuePeso;
	
	/**
	 * @Column(type="float", nullable=true)
	 */
	private ?float $price = null;
	
	/**
	 * @Column(type="string", nullable=true)
	 */
	private ?string $code = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 */
	private ?string $description = null;
	
	/**
	 * @Column(type="datetime")
	 */
	private \DateTime $date;
	
	/**
	 * @Column(type="string", nullable=true)
	 */
	private ?string $sender = null;
	
	/**
	 * @Column(type="boolean")
	 */
	private bool $status;
	
	/**
	 * @Column(type="datetime", nullable=true)
	 */
	private ?\DateTime $created = null;
	
	public function __construct()
	{
		$this->created = new \DateTime();
	}

	public function getCreated(): \DateTime
	{
		return $this->created;
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function isType(): bool
	{
		return $this->type;
	}

	public function setType(bool $type): Financial
	{
		$this->type = $type;
		return $this;
	}

	public function getClient(): Client
	{
		return $this->client;
	}

	public function setClient(Client $client): Financial
	{
		$this->client = $client;
		return $this;
	}

	public function getAccount(): ?Account
	{
		return $this->account;
	}

	public function setAccount(?Account $account): Financial
	{
		$this->account = $account;
		return $this;
	}

	public function getValueReal(): ?float
	{
		return $this->valueReal;
	}

	public function setValueReal(?float $valueReal): Financial
	{
		$this->valueReal = $valueReal;
		return $this;
	}

	public function getValuePeso(): float
	{
		return $this->valuePeso;
	}

	public function setValuePeso(float $valuePeso): Financial
	{
		$this->valuePeso = $valuePeso;
		return $this;
	}

	public function getPrice(): ?float
	{
		return $this->price;
	}

	public function setPrice(?float $price): Financial
	{
		$this->price = $price;
		return $this;
	}

	public function getCode(): ?string
	{
		return $this->code;
	}

	public function setCode(?string $code): Financial
	{
		$this->code = $code;
		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setDescription(?string $description): Financial
	{
		$this->description = $description;
		return $this;
	}

	public function getDate(): \DateTime
	{
		return $this->date;
	}

	public function setDate(\DateTime $date): Financial
	{
		$this->date = $date;
		return $this;
	}

	public function getSender(): ?string
	{
		return $this->sender;
	}

	public function setSender(?string $sender): Financial
	{
		$this->sender = $sender;
		return $this;
	}

	public function isStatus(): bool
	{
		return $this->status;
	}

	public function setStatus(bool $status): Financial
	{
		$this->status = $status;
		return $this;
	}
}