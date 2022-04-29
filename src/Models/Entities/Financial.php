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
	 * @Column(type="integer", nullable=true)
	 */
	private ?int $destiny = null;
	
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

	public function getDestiny(): ?int
	{
		return $this->destiny;
	}

	public function setDestiny(?int $destiny): Financial
	{
		$this->destiny = $destiny;
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
}