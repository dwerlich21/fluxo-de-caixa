<?php


namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="tool01Professional")
 * @ORM @Entity(repositoryClass="App\Models\Repository\Tool01ProfessionalRepository")
 */
class Tool01Professional
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
	/**
	 * @ManyToOne(targetEntity="Danger")
	 * @JoinColumn(name="danger", referencedColumnName="id")
	 * @var Danger
	 */
	private Danger $danger;
	
	/**
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(name="responsible", referencedColumnName="id", nullable=true)
	 * @var User|null
	 */
	private ?User $responsible = null;
	
	/**
	 * @ManyToOne(targetEntity="Office")
	 * @JoinColumn(name="office", referencedColumnName="id")
	 * @var Office
	 */
	private Office $office;
	
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
	
	public function getDanger(): Danger
	{
		return $this->danger;
	}
	
	public function setDanger(Danger $danger): Tool01Professional
	{
		$this->danger = $danger;
		return $this;
	}

	public function getResponsible(): ?User
	{
		return $this->responsible;
	}

	public function setResponsible(?User $responsible): Tool01Professional
	{
		$this->responsible = $responsible;
		return $this;
	}
	
	public function getP1(): string
	{
		return $this->p1;
	}
	
	public function setP1(string $p1): Tool01Professional
	{
		$this->p1 = $p1;
		return $this;
	}
	
	public function getP2(): string
	{
		return $this->p2;
	}
	
	public function setP2(string $p2): Tool01Professional
	{
		$this->p2 = $p2;
		return $this;
	}
	
	public function getP3(): string
	{
		return $this->p3;
	}
	
	public function setP3(string $p3): Tool01Professional
	{
		$this->p3 = $p3;
		return $this;
	}
	
	public function getP4(): string
	{
		return $this->p4;
	}
	
	public function setP4(string $p4): Tool01Professional
	{
		$this->p4 = $p4;
		return $this;
	}
	
	public function getP5(): string
	{
		return $this->p5;
	}
	
	public function setP5(string $p5): Tool01Professional
	{
		$this->p5 = $p5;
		return $this;
	}

	public function getOffice(): Office
	{
		return $this->office;
	}

	public function setOffice(Office $office): Tool01Professional
	{
		$this->office = $office;
		return $this;
	}
}