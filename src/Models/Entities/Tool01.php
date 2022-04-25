<?php


namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="tool01")
 * @ORM @Entity(repositoryClass="App\Models\Repository\Tool01Repository")
 */
class Tool01
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
	private string $p1;
	
	/**
	 * @Column(type="text")
	 * @var string
	 */
	private string $p2;
	
	/**
	 * @Column(type="text")
	 * @var string
	 */
	private string $p3;
	
	/**
	 * @Column(type="text")
	 * @var string
	 */
	private string $p4;
	
	/**
	 * @Column(type="text")
	 * @var string
	 */
	private string $p5;
	
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getResponsible(): User
	{
		return $this->responsible;
	}
	
	public function setResponsible(User $responsible): Tool01
	{
		$this->responsible = $responsible;
		return $this;
	}
	
	public function getCompany(): Company
	{
		return $this->company;
	}
	
	public function setCompany(Company $company): Tool01
	{
		$this->company = $company;
		return $this;
	}
	
	public function getDanger(): Danger
	{
		return $this->danger;
	}
	
	public function setDanger(Danger $danger): Tool01
	{
		$this->danger = $danger;
		return $this;
	}
	
	public function getP1(): string
	{
		return $this->p1;
	}
	
	public function setP1(string $p1): Tool01
	{
		$this->p1 = $p1;
		return $this;
	}
	
	public function getP2(): string
	{
		return $this->p2;
	}
	
	public function setP2(string $p2): Tool01
	{
		$this->p2 = $p2;
		return $this;
	}
	
	public function getP3(): string
	{
		return $this->p3;
	}
	
	public function setP3(string $p3): Tool01
	{
		$this->p3 = $p3;
		return $this;
	}
	
	public function getP4(): string
	{
		return $this->p4;
	}
	
	public function setP4(string $p4): Tool01
	{
		$this->p4 = $p4;
		return $this;
	}
	
	public function getP5(): string
	{
		return $this->p5;
	}
	
	public function setP5(string $p5): Tool01
	{
		$this->p5 = $p5;
		return $this;
	}
}