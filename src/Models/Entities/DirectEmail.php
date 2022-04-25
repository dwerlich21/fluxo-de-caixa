<?php


namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="directEmail")
 * @ORM @Entity(repositoryClass="App\Models\Repository\DirectEmailRepository")
 */
class DirectEmail
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
	 * @ManyToOne(targetEntity="Danger")
	 * @JoinColumn(name="danger", referencedColumnName="id")
	 * @var Danger
	 */
	private Danger $danger;
	
	/**
	 * @Column(type="text")
	 * @var string
	 */
	private string $description;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private string $email;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private string $professional;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private string $token;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $tool;
	
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $active;
	
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $status;
	
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getResponsible(): User
	{
		return $this->responsible;
	}
	
	public function setResponsible(User $responsible): DirectEmail
	{
		$this->responsible = $responsible;
		return $this;
	}
	
	public function getCompany(): Company
	{
		return $this->company;
	}
	
	public function setCompany(Company $company): DirectEmail
	{
		$this->company = $company;
		return $this;
	}
	
	public function getDanger(): Danger
	{
		return $this->danger;
	}
	
	public function setDanger(Danger $danger): DirectEmail
	{
		$this->danger = $danger;
		return $this;
	}
	
	public function getDescription(): string
	{
		return $this->description;
	}
	
	public function setDescription(string $description): DirectEmail
	{
		$this->description = $description;
		return $this;
	}
	
	public function getEmail(): string
	{
		return $this->email;
	}
	
	public function setEmail(string $email): DirectEmail
	{
		$this->email = $email;
		return $this;
	}
	
	public function getProfessional(): string
	{
		return $this->professional;
	}
	
	public function setProfessional(string $professional): DirectEmail
	{
		$this->professional = $professional;
		return $this;
	}
	
	public function getToken(): string
	{
		return $this->token;
	}
	
	public function setToken(string $token): DirectEmail
	{
		$this->token = $token;
		return $this;
	}
	
	public function isStatus(): bool
	{
		return $this->status;
	}
	
	public function setStatus(bool $status): DirectEmail
	{
		$this->status = $status;
		return $this;
	}
	
	public function isActive(): bool
	{
		return $this->active;
	}
	
	public function setActive(bool $active): DirectEmail
	{
		$this->active = $active;
		return $this;
	}
	
	public function activeStr(): string
	{
		if (1 == $this->active) {
			return "Liberadas";
		}
		return "Bloqueadas";
		
	}
	
	public function getTool(): int
	{
		return $this->tool;
	}
	
	public function setTool(int $tool): DirectEmail
	{
		$this->tool = $tool;
		return $this;
	}
}