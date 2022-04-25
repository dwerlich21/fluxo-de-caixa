<?php

namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="office")
 * @ORM @Entity(repositoryClass="App\Models\Repository\OfficeRepository")
 */
class Office
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
	/**
	 * @Column(type="string")
	 */
	private string $name;
	
	/**
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(name="responsible", referencedColumnName="id")
	 * @var User
	 */
	private User $responsible;
	
	/**
	 * @ManyToOne(targetEntity="Occupation")
	 * @JoinColumn(name="occupation", referencedColumnName="id", nullable=true)
	 * @var Occupation|null
	 */
	private ?Occupation $occupation = null;
	
	/**
	 * @ManyToOne(targetEntity="Environment")
	 * @JoinColumn(name="environment", referencedColumnName="id", nullable=true)
	 * @var Environment
	 */
	private Environment $environment;
	
	/**
	 * @ManyToOne(targetEntity="Company")
	 * @JoinColumn(name="company", referencedColumnName="id")
	 * @var Company
	 */
	private Company $company;
	
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $active;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string |null
	 */
	private ?string $scalesOuter = '';
	
	/**
	 * @Column(type="integer", nullable=true)
	 * @var int
	 */
	private int $scales;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private string $dailyJourney;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private string $weekday;
	
	/**
	 * @Column(type="integer")
	 */
	private int $man;
	
	/**
	 * @Column(type="integer")
	 */
	private int $woman;
	
	/**
	 * @Column(type="integer")
	 */
	private int $minors;
	
	
	public function getEnvironment(): Environment
	{
		return $this->environment;
	}
	
	public function setEnvironment(Environment $environment): Office
	{
		$this->environment = $environment;
		return $this;
	}
	
	public function getDailyJourney(): string
	{
		return $this->dailyJourney;
	}
	
	public function setDailyJourney(string $dailyJourney): Office
	{
		$this->dailyJourney = $dailyJourney;
		return $this;
	}
	
	public function getWeekday(): string
	{
		return $this->weekday;
	}
	
	public function setWeekday(string $weekday): Office
	{
		$this->weekday = $weekday;
		return $this;
	}
	
	public function getOccupation(): ?Occupation
	{
		return $this->occupation;
	}
	
	public function setOccupation(?Occupation $occupation): Office
	{
		$this->occupation = $occupation;
		return $this;
	}
	
	public function getId(): int
	{
		return $this->id;
	}
	
	public function getName(): string
	{
		return $this->name;
	}
	
	public function setName(string $name): Office
	{
		$this->name = $name;
		return $this;
	}
	
	public function getResponsible(): User
	{
		return $this->responsible;
	}
	
	public function setResponsible(User $responsible): Office
	{
		$this->responsible = $responsible;
		return $this;
	}
	
	public function getCompany(): Company
	{
		return $this->company;
	}
	
	public function setCompany(Company $company): Office
	{
		$this->company = $company;
		return $this;
	}
	
	
	public function isActive(): bool
	{
		return $this->active;
	}
	
	public function setActive(bool $active): Office
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
	
	public function getScalesOuter(): ?string
	{
		return $this->scalesOuter;
	}
	
	public function setScalesOuter(?string $scalesOuter): Office
	{
		$this->scalesOuter = $scalesOuter;
		return $this;
	}
	
	public function getScales(): int
	{
		return $this->scales;
	}
	
	public function setScales(int $scales): Office
	{
		$this->scales = $scales;
		return $this;
	}

	public function getMan(): int
	{
		return $this->man;
	}

	public function setMan(int $man): Office
	{
		$this->man = $man;
		return $this;
	}

	public function getWoman(): int
	{
		return $this->woman;
	}

	public function setWoman(int $woman): Office
	{
		$this->woman = $woman;
		return $this;
	}

	public function getMinors(): int
	{
		return $this->minors;
	}

	public function setMinors(int $minors): Office
	{
		$this->minors = $minors;
		return $this;
	}
}
