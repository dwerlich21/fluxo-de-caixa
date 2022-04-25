<?php

namespace App\Models\Entities;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="equipament")
 * @ORM @Entity(repositoryClass="App\Models\Repository\EquipamentRepository")
 */
class Equipament
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
	 * @ManyToOne(targetEntity="Consultant")
	 * @JoinColumn(name="consultant", referencedColumnName="id")
	 * @var Consultant
	 */
	private Consultant $consultant;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private string $name;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private string $doc;
	
	/**
	 * @Column(type="string")
	 */
	private string $brand;
	
	/**
	 * @Column(type="string")
	 */
	private string $model;
	
	/**
	 * @Column(type="string")
	 */
	private string $serial;
	
	/**
	 * @Column(type="string")
	 */
	private string $certificate;
	
	/**
	 * @Column(type="date")
	 */
	private \DateTime $date;
	
	/**
	 * @Column(type="date")
	 */
	private \DateTime $validity;
	
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $active;
	

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getResponsible(): User
	{
		return $this->responsible;
	}

	public function setResponsible(User $responsible): Equipament
	{
		$this->responsible = $responsible;
		return $this;
	}

	public function getConsultant(): Consultant
	{
		return $this->consultant;
	}

	public function setConsultant(Consultant $consultant): Equipament
	{
		$this->consultant = $consultant;
		return $this;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): Equipament
	{
		$this->name = $name;
		return $this;
	}

	public function getDoc(): string
	{
		return $this->doc;
	}

	public function setDoc(string $doc): Equipament
	{
		$this->doc = substr($doc, strrpos($doc, '/') + 1);
		return $this;
	}
	
	public function activeStr(): string
	{
		if (1 == $this->active) {
			return "Ativo";
		}
		return "Inativo";
		
	}

	public function isActive(): bool
	{
		return $this->active;
	}

	public function setActive(bool $active): Equipament
	{
		$this->active = $active;
		return $this;
	}

	public function getBrand(): string
	{
		return $this->brand;
	}

	public function setBrand(string $brand): Equipament
	{
		$this->brand = $brand;
		return $this;
	}

	public function getModel(): string
	{
		return $this->model;
	}

	public function setModel(string $model): Equipament
	{
		$this->model = $model;
		return $this;
	}

	public function getSerial(): string
	{
		return $this->serial;
	}

	public function setSerial(string $serial): Equipament
	{
		$this->serial = $serial;
		return $this;
	}

	public function getDate(): \DateTime
	{
		return $this->date;
	}

	public function setDate(\DateTime $date): Equipament
	{
		$this->date = $date;
		return $this;
	}

	public function getValidity(): \DateTime
	{
		return $this->validity;
	}

	public function setValidity(\DateTime $validity): Equipament
	{
		$this->validity = $validity;
		return $this;
	}

	public function getCertificate(): string
	{
		return $this->certificate;
	}

	public function setCertificate(string $certificate): Equipament
	{
		$this->certificate = $certificate;
		return $this;
	}
}