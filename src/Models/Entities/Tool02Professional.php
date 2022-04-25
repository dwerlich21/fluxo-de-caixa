<?php
namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="tool02Professional")
 * @ORM @Entity(repositoryClass="App\Models\Repository\Tool02ProfessionalRepository")
 */
class Tool02Professional
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
	private int $p18;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p19;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p20;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $p21;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $total1;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $total2;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $total3;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $total4;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $total5;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $total6;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $percentage1;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $percentage2;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $percentage3;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $percentage4;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $percentage5;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $percentage6;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $result;
	
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getDanger(): Danger
	{
		return $this->danger;
	}
	
	public function setDanger(Danger $danger): Tool02Professional
	{
		$this->danger = $danger;
		return $this;
	}
	
	public function getResponsible(): ?User
	{
		return $this->responsible;
	}

	public function setResponsible(?User $responsible): Tool02Professional
	{
		$this->responsible = $responsible;
		return $this;
	}
	
	public function getP1(): int
	{
		return $this->p1;
	}
	
	public function setP1(int $p1): Tool02Professional
	{
		$this->p1 = $p1;
		return $this;
	}
	
	public function getP2(): int
	{
		return $this->p2;
	}
	
	public function setP2(int $p2): Tool02Professional
	{
		$this->p2 = $p2;
		return $this;
	}
	
	public function getP3(): int
	{
		return $this->p3;
	}
	
	public function setP3(int $p3): Tool02Professional
	{
		$this->p3 = $p3;
		return $this;
	}
	
	public function getP4(): int
	{
		return $this->p4;
	}
	
	public function setP4(int $p4): Tool02Professional
	{
		$this->p4 = $p4;
		return $this;
	}
	
	public function getP5(): int
	{
		return $this->p5;
	}
	
	public function setP5(int $p5): Tool02Professional
	{
		$this->p5 = $p5;
		return $this;
	}
	
	public function getP6(): int
	{
		return $this->p6;
	}
	
	public function setP6(int $p6): Tool02Professional
	{
		$this->p6 = $p6;
		return $this;
	}
	
	public function getP7(): int
	{
		return $this->p7;
	}
	
	public function setP7(int $p7): Tool02Professional
	{
		$this->p7 = $p7;
		return $this;
	}
	
	public function getP8(): int
	{
		return $this->p8;
	}
	
	public function setP8(int $p8): Tool02Professional
	{
		$this->p8 = $p8;
		return $this;
	}
	
	public function getP9(): int
	{
		return $this->p9;
	}
	
	public function setP9(int $p9): Tool02Professional
	{
		$this->p9 = $p9;
		return $this;
	}
	
	public function getP10(): int
	{
		return $this->p10;
	}
	
	public function setP10(int $p10): Tool02Professional
	{
		$this->p10 = $p10;
		return $this;
	}
	
	public function getP11(): int
	{
		return $this->p11;
	}
	
	public function setP11(int $p11): Tool02Professional
	{
		$this->p11 = $p11;
		return $this;
	}
	
	public function getP12(): int
	{
		return $this->p12;
	}
	
	public function setP12(int $p12): Tool02Professional
	{
		$this->p12 = $p12;
		return $this;
	}
	
	public function getP13(): int
	{
		return $this->p13;
	}
	
	public function setP13(int $p13): Tool02Professional
	{
		$this->p13 = $p13;
		return $this;
	}
	
	public function getP14(): int
	{
		return $this->p14;
	}
	
	public function setP14(int $p14): Tool02Professional
	{
		$this->p14 = $p14;
		return $this;
	}
	
	public function getP15(): int
	{
		return $this->p15;
	}
	
	public function setP15(int $p15): Tool02Professional
	{
		$this->p15 = $p15;
		return $this;
	}
	
	public function getP16(): int
	{
		return $this->p16;
	}
	
	public function setP16(int $p16): Tool02Professional
	{
		$this->p16 = $p16;
		return $this;
	}
	
	public function getP17(): int
	{
		return $this->p17;
	}
	
	public function setP17(int $p17): Tool02Professional
	{
		$this->p17 = $p17;
		return $this;
	}
	
	public function getP18(): int
	{
		return $this->p18;
	}
	
	public function setP18(int $p18): Tool02Professional
	{
		$this->p18 = $p18;
		return $this;
	}
	
	public function getP19(): int
	{
		return $this->p19;
	}
	
	public function setP19(int $p19): Tool02Professional
	{
		$this->p19 = $p19;
		return $this;
	}
	
	public function getP20(): int
	{
		return $this->p20;
	}
	
	public function setP20(int $p20): Tool02Professional
	{
		$this->p20 = $p20;
		return $this;
	}
	
	public function getP21(): int
	{
		return $this->p21;
	}
	
	public function setP21(int $p21): Tool02Professional
	{
		$this->p21 = $p21;
		return $this;
	}

	public function getTotal1(): int
	{
		return $this->total1;
	}

	public function setTotal1(int $total1): Tool02Professional
	{
		$this->total1 = $total1;
		return $this;
	}

	public function getTotal2(): int
	{
		return $this->total2;
	}

	public function setTotal2(int $total2): Tool02Professional
	{
		$this->total2 = $total2;
		return $this;
	}

	public function getTotal3(): int
	{
		return $this->total3;
	}

	public function setTotal3(int $total3): Tool02Professional
	{
		$this->total3 = $total3;
		return $this;
	}

	public function getTotal4(): int
	{
		return $this->total4;
	}

	public function setTotal4(int $total4): Tool02Professional
	{
		$this->total4 = $total4;
		return $this;
	}

	public function getTotal5(): int
	{
		return $this->total5;
	}

	public function setTotal5(int $total5): Tool02Professional
	{
		$this->total5 = $total5;
		return $this;
	}

	public function getTotal6(): int
	{
		return $this->total6;
	}

	public function setTotal6(int $total6): Tool02Professional
	{
		$this->total6 = $total6;
		return $this;
	}
	
	public function getResult(): int
	{
		return $this->result;
	}
	
	public function setResult(int $result): Tool02Professional
	{
		$this->result = $result;
		return $this;
	}
	
	public function getPercentage1(): int
	{
		return $this->percentage1;
	}
	
	public function setPercentage1(int $percentage1): Tool02Professional
	{
		$this->percentage1 = $percentage1;
		return $this;
	}
	
	public function getPercentage2(): int
	{
		return $this->percentage2;
	}
	
	public function setPercentage2(int $percentage2): Tool02Professional
	{
		$this->percentage2 = $percentage2;
		return $this;
	}
	
	public function getPercentage3(): int
	{
		return $this->percentage3;
	}
	
	public function setPercentage3(int $percentage3): Tool02Professional
	{
		$this->percentage3 = $percentage3;
		return $this;
	}
	
	public function getPercentage4(): int
	{
		return $this->percentage4;
	}
	
	public function setPercentage4(int $percentage4): Tool02Professional
	{
		$this->percentage4 = $percentage4;
		return $this;
	}
	
	public function getPercentage5(): int
	{
		return $this->percentage5;
	}
	
	public function setPercentage5(int $percentage5): Tool02Professional
	{
		$this->percentage5 = $percentage5;
		return $this;
	}
	
	public function getPercentage6(): int
	{
		return $this->percentage6;
	}
	
	public function setPercentage6(int $percentage6): Tool02Professional
	{
		$this->percentage6 = $percentage6;
		return $this;
	}

	public function getOffice(): Office
	{
		return $this->office;
	}

	public function setOffice(Office $office): Tool02Professional
	{
		$this->office = $office;
		return $this;
	}
}