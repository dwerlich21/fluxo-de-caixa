<?php


namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="process")
 * @ORM @Entity(repositoryClass="App\Models\Repository\ProcessRepository")
 */
class Process
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 * @var int
	 */
	private int $id;
	
	/**
	 * @ManyToOne(targetEntity="Company")
	 * @JoinColumn(name="company", referencedColumnName="id")
	 * @var Company
	 */
	private Company $company;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private string $name;
	
	/**
	 * @Column(type="text")
	 * @var string
	 */
	private string $description;
	
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $active;
	
	/**
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(name="responsible", referencedColumnName="id")
	 * @var User
	 */
	private User $responsible;
	
	
	public function getId(): int
	{
		return $this->id;
	}
	
	public function getCompany(): Company
	{
		return $this->company;
	}
	
	public function setCompany(Company $company): Process
	{
		$this->company = $company;
		return $this;
	}
	
	public function getName(): string
	{
		return $this->name;
	}
	
	public function setName(string $name): Process
	{
		$this->name = $name;
		return $this;
	}
	
	public function getDescription(): string
	{
		return $this->description;
	}
	
	public function setDescription(string $description): Process
	{
		$this->description = $description;
		return $this;
	}
	
	public function isActive(): bool
	{
		return $this->active;
	}
	
	public function setActive(bool $active): Process
	{
		$this->active = $active;
		return $this;
	}
	
	public function activeStr(): string
	{
		if (1 == $this->active) {
			return "Ativo";
		}
		return "Inativo";
		
	}
	
	public function getResponsible(): User
	{
		return $this->responsible;
	}
	
	public function setResponsible(User $responsible): Process
	{
		$this->responsible = $responsible;
		return $this;
	}
}