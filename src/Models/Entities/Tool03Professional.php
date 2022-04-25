<?php


namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="tool03Professional")
 * @ORM @Entity(repositoryClass="App\Models\Repository\Tool03ProfessionalRepository")
 */
class Tool03Professional
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
	/**
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(name="responsible", referencedColumnName="id")
	 * @var User|null
	 */
	private ?User $responsible = null;
	
	/**
	 * @ManyToOne(targetEntity="Danger")
	 * @JoinColumn(name="danger", referencedColumnName="id")
	 * @var Danger
	 */
	private Danger $danger;
	
	/**
	 * @ManyToOne(targetEntity="Office")
	 * @JoinColumn(name="office", referencedColumnName="id")
	 * @var Office
	 */
	private Office $office;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p1;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p2;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p3;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p4;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p5;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p6;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p7;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p8;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p9;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p10;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p11;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p12;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p13;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p14;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p15;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p16;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p17;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $resultDemand;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $resultControl;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $resultSocialSupport;
	
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}
	
	public function getResponsible(): ?User
	{
		return $this->responsible;
	}
	
	public function setResponsible(?User $responsible): Tool03Professional
	{
		$this->responsible = $responsible;
		return $this;
	}

	public function getDanger(): Danger
	{
		return $this->danger;
	}
	
	public function setDanger(Danger $danger): Tool03Professional
	{
		$this->danger = $danger;
		return $this;
	}
	
	public function getP1(): int
	{
		return $this->p1;
	}
	
	public function setP1(int $p1): Tool03Professional
	{
		$this->p1 = $p1;
		return $this;
	}
	
	public function getP2(): int
	{
		return $this->p2;
	}
	
	public function setP2(int $p2): Tool03Professional
	{
		$this->p2 = $p2;
		return $this;
	}
	
	public function getP3(): int
	{
		return $this->p3;
	}
	
	public function setP3(int $p3): Tool03Professional
	{
		$this->p3 = $p3;
		return $this;
	}
	
	public function getP4(): int
	{
		return $this->p4;
	}
	
	public function setP4(int $p4): Tool03Professional
	{
		$this->p4 = $p4;
		return $this;
	}
	
	public function getP5(): int
	{
		return $this->p5;
	}
	
	public function setP5(int $p5): Tool03Professional
	{
		$this->p5 = $p5;
		return $this;
	}
	
	public function getP6(): int
	{
		return $this->p6;
	}
	
	public function setP6(int $p6): Tool03Professional
	{
		$this->p6 = $p6;
		return $this;
	}
	
	public function getP7(): int
	{
		return $this->p7;
	}
	
	public function setP7(int $p7): Tool03Professional
	{
		$this->p7 = $p7;
		return $this;
	}
	
	public function getP8(): int
	{
		return $this->p8;
	}
	
	public function setP8(int $p8): Tool03Professional
	{
		$this->p8 = $p8;
		return $this;
	}
	
	public function getP9(): int
	{
		return $this->p9;
	}
	
	public function setP9(int $p9): Tool03Professional
	{
		$this->p9 = $p9;
		return $this;
	}
	
	public function getP10(): int
	{
		return $this->p10;
	}
	
	public function setP10(int $p10): Tool03Professional
	{
		$this->p10 = $p10;
		return $this;
	}
	
	public function getP11(): int
	{
		return $this->p11;
	}
	
	public function setP11(int $p11): Tool03Professional
	{
		$this->p11 = $p11;
		return $this;
	}
	
	public function getP12(): int
	{
		return $this->p12;
	}
	
	public function setP12(int $p12): Tool03Professional
	{
		$this->p12 = $p12;
		return $this;
	}
	
	public function getP13(): int
	{
		return $this->p13;
	}
	
	public function setP13(int $p13): Tool03Professional
	{
		$this->p13 = $p13;
		return $this;
	}
	
	public function getP14(): int
	{
		return $this->p14;
	}
	
	public function setP14(int $p14): Tool03Professional
	{
		$this->p14 = $p14;
		return $this;
	}
	
	public function getP15(): int
	{
		return $this->p15;
	}
	
	public function setP15(int $p15): Tool03Professional
	{
		$this->p15 = $p15;
		return $this;
	}
	
	public function getP16(): int
	{
		return $this->p16;
	}
	
	public function setP16(int $p16): Tool03Professional
	{
		$this->p16 = $p16;
		return $this;
	}
	
	public function getP17(): int
	{
		return $this->p17;
	}
	
	public function setP17(int $p17): Tool03Professional
	{
		$this->p17 = $p17;
		return $this;
	}
	
	public function getResultDemand(): int
	{
		return $this->resultDemand;
	}
	
	public function setResultDemand(int $resultDemand): Tool03Professional
	{
		$this->resultDemand = $resultDemand;
		return $this;
	}
	
	public function getResultControl(): int
	{
		return $this->resultControl;
	}
	
	public function setResultControl(int $resultControl): Tool03Professional
	{
		$this->resultControl = $resultControl;
		return $this;
	}
	
	public function getResultSocialSupport(): int
	{
		return $this->resultSocialSupport;
	}
	
	public function setResultSocialSupport(int $resultSocialSupport): Tool03Professional
	{
		$this->resultSocialSupport = $resultSocialSupport;
		return $this;
	}

	public function getOffice(): Office
	{
		return $this->office;
	}

	public function setOffice(Office $office): Tool03Professional
	{
		$this->office = $office;
		return $this;
	}
}