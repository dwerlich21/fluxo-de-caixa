<?php


namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="tool07")
 * @ORM @Entity(repositoryClass="App\Models\Repository\Tool07Repository")
 */
class Tool07
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
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p1;
	
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p2;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p3;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p4;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p5;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p6;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p7;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p8;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p9;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p10;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p11;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p12;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p13;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p14;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p15;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p16;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $p17;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $result11;
	
	/**
	 * @Column(type="boolean")
	 */
	private bool $resultTotal;
	
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getResponsible(): User
	{
		return $this->responsible;
	}
	
	public function setResponsible(User $responsible): Tool07
	{
		$this->responsible = $responsible;
		return $this;
	}
	
	public function getCompany(): Company
	{
		return $this->company;
	}
	
	public function setCompany(Company $company): Tool07
	{
		$this->company = $company;
		return $this;
	}
	
	public function getDanger(): Danger
	{
		return $this->danger;
	}
	
	public function setDanger(Danger $danger): Tool07
	{
		$this->danger = $danger;
		return $this;
	}
	
	public function isP1(): bool
	{
		return $this->p1;
	}
	
	public function setP1(bool $p1): Tool07
	{
		$this->p1 = $p1;
		return $this;
	}
	
	public function isP2(): bool
	{
		return $this->p2;
	}
	
	public function setP2(bool $p2): Tool07
	{
		$this->p2 = $p2;
		return $this;
	}
	
	public function isP3(): bool
	{
		return $this->p3;
	}
	
	public function setP3(bool $p3): Tool07
	{
		$this->p3 = $p3;
		return $this;
	}
	
	public function isP4(): bool
	{
		return $this->p4;
	}
	
	public function setP4(bool $p4): Tool07
	{
		$this->p4 = $p4;
		return $this;
	}
	
	public function isP5(): bool
	{
		return $this->p5;
	}
	
	public function setP5(bool $p5): Tool07
	{
		$this->p5 = $p5;
		return $this;
	}
	
	public function isP6(): bool
	{
		return $this->p6;
	}
	
	public function setP6(bool $p6): Tool07
	{
		$this->p6 = $p6;
		return $this;
	}
	
	public function isP7(): bool
	{
		return $this->p7;
	}
	
	public function setP7(bool $p7): Tool07
	{
		$this->p7 = $p7;
		return $this;
	}
	
	public function isP8(): bool
	{
		return $this->p8;
	}
	
	public function setP8(bool $p8): Tool07
	{
		$this->p8 = $p8;
		return $this;
	}
	
	public function isP9(): bool
	{
		return $this->p9;
	}
	
	public function setP9(bool $p9): Tool07
	{
		$this->p9 = $p9;
		return $this;
	}
	
	public function isP10(): bool
	{
		return $this->p10;
	}
	
	public function setP10(bool $p10): Tool07
	{
		$this->p10 = $p10;
		return $this;
	}
	
	public function isP11(): bool
	{
		return $this->p11;
	}
	
	public function setP11(bool $p11): Tool07
	{
		$this->p11 = $p11;
		return $this;
	}
	
	public function isP12(): bool
	{
		return $this->p12;
	}
	
	public function setP12(bool $p12): Tool07
	{
		$this->p12 = $p12;
		return $this;
	}
	
	public function isP13(): bool
	{
		return $this->p13;
	}
	
	public function setP13(bool $p13): Tool07
	{
		$this->p13 = $p13;
		return $this;
	}
	
	public function isP14(): bool
	{
		return $this->p14;
	}
	
	public function setP14(bool $p14): Tool07
	{
		$this->p14 = $p14;
		return $this;
	}
	
	public function isP15(): bool
	{
		return $this->p15;
	}
	
	public function setP15(bool $p15): Tool07
	{
		$this->p15 = $p15;
		return $this;
	}
	
	public function isP16(): bool
	{
		return $this->p16;
	}
	
	public function setP16(bool $p16): Tool07
	{
		$this->p16 = $p16;
		return $this;
	}
	
	public function isP17(): bool
	{
		return $this->p17;
	}
	
	public function setP17(bool $p17): Tool07
	{
		$this->p17 = $p17;
		return $this;
	}
	
	public function isResult11(): bool
	{
		return $this->result11;
	}
	
	public function setResult11(bool $result11): Tool07
	{
		$this->result11 = $result11;
		return $this;
	}
	
	public function isResultTotal(): bool
	{
		return $this->resultTotal;
	}

	public function setResultTotal(bool $resultTotal): Tool07
	{
		$this->resultTotal = $resultTotal;
		return $this;
	}
}