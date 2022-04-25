<?php


namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="tool05")
 * @ORM @Entity(repositoryClass="App\Models\Repository\Tool05Repository")
 */
class Tool05
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
	 * @var bool|null
	 */
	private ?bool $p1 = null;
	
	/**
	 * @Column(type="boolean")
	 * @var bool|null
	 */
	private ?bool $p2 = null;
	/**
	 * @Column(type="boolean")
	 * @var bool|null
	 */
	private ?bool $p3 = null;
	/**
	 * @Column(type="boolean")
	 * @var bool|null
	 */
	private ?bool $p4 = null;
	/**
	 * @Column(type="boolean")
	 * @var bool|null
	 */
	private ?bool $p5 = null;
	/**
	 * @Column(type="boolean")
	 * @var bool|null
	 */
	private ?bool $p6 = null;
	/**
	 * @Column(type="boolean")
	 * @var bool|null
	 */
	private ?bool $p7 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p8 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p9 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p10 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p11 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p12 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p13 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p14 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p15 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p16 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p17 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p18 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p19 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p20 = null;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $result6;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $result7;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $result8;
	
	/**
	 * @Column(type="boolean")
	 */
	private bool $resultTotal;
	
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}
	
	public function getResponsible(): User
	{
		return $this->responsible;
	}
	
	public function setResponsible(User $responsible): Tool05
	{
		$this->responsible = $responsible;
		return $this;
	}
	
	
	public function getCompany(): Company
	{
		return $this->company;
	}
	
	public function setCompany(Company $company): Tool05
	{
		$this->company = $company;
		return $this;
	}
	
	public function getDanger(): Danger
	{
		return $this->danger;
	}
	
	public function setDanger(Danger $danger): Tool05
	{
		$this->danger = $danger;
		return $this;
	}
	
	public function getP1(): ?bool
	{
		return $this->p1;
	}
	
	public function setP1(?bool $p1): Tool05
	{
		$this->p1 = $p1;
		return $this;
	}
	
	public function getP2(): ?bool
	{
		return $this->p2;
	}
	
	public function setP2(?bool $p2): Tool05
	{
		$this->p2 = $p2;
		return $this;
	}
	
	public function getP3(): ?bool
	{
		return $this->p3;
	}
	
	public function setP3(?bool $p3): Tool05
	{
		$this->p3 = $p3;
		return $this;
	}
	
	public function getP4(): ?bool
	{
		return $this->p4;
	}
	
	public function setP4(?bool $p4): Tool05
	{
		$this->p4 = $p4;
		return $this;
	}
	
	public function getP5(): ?bool
	{
		return $this->p5;
	}
	
	public function setP5(?bool $p5): Tool05
	{
		$this->p5 = $p5;
		return $this;
	}
	
	public function getP6(): ?bool
	{
		return $this->p6;
	}
	
	public function setP6(?bool $p6): Tool05
	{
		$this->p6 = $p6;
		return $this;
	}
	
	public function getP7(): ?bool
	{
		return $this->p7;
	}
	
	public function setP7(?bool $p7): Tool05
	{
		$this->p7 = $p7;
		return $this;
	}
	
	public function getP8(): ?bool
	{
		return $this->p8;
	}
	
	public function setP8(?bool $p8): Tool05
	{
		$this->p8 = $p8;
		return $this;
	}
	
	public function getP9(): ?bool
	{
		return $this->p9;
	}
	
	public function setP9(?bool $p9): Tool05
	{
		$this->p9 = $p9;
		return $this;
	}
	
	public function getP10(): ?bool
	{
		return $this->p10;
	}
	
	public function setP10(?bool $p10): Tool05
	{
		$this->p10 = $p10;
		return $this;
	}
	
	public function getP11(): ?bool
	{
		return $this->p11;
	}
	
	public function setP11(?bool $p11): Tool05
	{
		$this->p11 = $p11;
		return $this;
	}
	
	public function getP12(): ?bool
	{
		return $this->p12;
	}
	
	public function setP12(?bool $p12): Tool05
	{
		$this->p12 = $p12;
		return $this;
	}
	
	public function getP13(): ?bool
	{
		return $this->p13;
	}
	
	public function setP13(?bool $p13): Tool05
	{
		$this->p13 = $p13;
		return $this;
	}
	
	public function getP14(): ?bool
	{
		return $this->p14;
	}
	
	public function setP14(?bool $p14): Tool05
	{
		$this->p14 = $p14;
		return $this;
	}
	
	public function getP15(): ?bool
	{
		return $this->p15;
	}
	
	public function setP15(?bool $p15): Tool05
	{
		$this->p15 = $p15;
		return $this;
	}
	
	public function getP16(): ?bool
	{
		return $this->p16;
	}
	
	public function setP16(?bool $p16): Tool05
	{
		$this->p16 = $p16;
		return $this;
	}
	
	public function getP17(): ?bool
	{
		return $this->p17;
	}
	
	public function setP17(?bool $p17): Tool05
	{
		$this->p17 = $p17;
		return $this;
	}
	
	public function getP18(): ?bool
	{
		return $this->p18;
	}
	
	public function setP18(?bool $p18): Tool05
	{
		$this->p18 = $p18;
		return $this;
	}
	
	public function getP19(): ?bool
	{
		return $this->p19;
	}
	
	public function setP19(?bool $p19): Tool05
	{
		$this->p19 = $p19;
		return $this;
	}
	
	public function getP20(): ?bool
	{
		return $this->p20;
	}
	
	public function setP20(?bool $p20): Tool05
	{
		$this->p20 = $p20;
		return $this;
	}

	public function isResult6(): bool
	{
		return $this->result6;
	}

	public function setResult6(bool $result6): Tool05
	{
		$this->result6 = $result6;
		return $this;
	}

	public function isResult7(): bool
	{
		return $this->result7;
	}

	public function setResult7(bool $result7): Tool05
	{
		$this->result7 = $result7;
		return $this;
	}

	public function isResult8(): bool
	{
		return $this->result8;
	}

	public function setResult8(bool $result8): Tool05
	{
		$this->result8 = $result8;
		return $this;
	}

	public function isResultTotal(): bool
	{
		return $this->resultTotal;
	}

	public function setResultTotal(bool $resultTotal): Tool05
	{
		$this->resultTotal = $resultTotal;
		return $this;
	}
}