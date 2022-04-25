<?php


namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="tool04")
 * @ORM @Entity(repositoryClass="App\Models\Repository\Tool04Repository")
 */
class Tool04
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
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p21 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p22 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p23 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p24 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p25 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p26 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p27 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p28 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p29 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p30 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p31 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p32 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p33 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p34 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p35 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p36 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p37 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p38 = null;
	/**
	 * @Column(type="boolean", nullable=true)
	 * @var bool|null
	 */
	private ?bool $p39 = null;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $result2;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $result3;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $result4;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $result5;
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
	
	public function setResponsible(User $responsible): Tool04
	{
		$this->responsible = $responsible;
		return $this;
	}
	
	public function getCompany(): Company
	{
		return $this->company;
	}
	
	public function setCompany(Company $company): Tool04
	{
		$this->company = $company;
		return $this;
	}
	
	public function getDanger(): Danger
	{
		return $this->danger;
	}
	
	public function setDanger(Danger $danger): Tool04
	{
		$this->danger = $danger;
		return $this;
	}
	
	public function getP1(): ?bool
	{
		return $this->p1;
	}
	
	public function setP1(?bool $p1): Tool04
	{
		$this->p1 = $p1;
		return $this;
	}
	
	public function getP2(): ?bool
	{
		return $this->p2;
	}
	
	public function setP2(?bool $p2): Tool04
	{
		$this->p2 = $p2;
		return $this;
	}
	
	public function getP3(): ?bool
	{
		return $this->p3;
	}
	
	public function setP3(?bool $p3): Tool04
	{
		$this->p3 = $p3;
		return $this;
	}
	
	public function getP4(): ?bool
	{
		return $this->p4;
	}
	
	public function setP4(?bool $p4): Tool04
	{
		$this->p4 = $p4;
		return $this;
	}
	
	public function getP5(): ?bool
	{
		return $this->p5;
	}
	
	public function setP5(?bool $p5): Tool04
	{
		$this->p5 = $p5;
		return $this;
	}
	
	public function getP6(): ?bool
	{
		return $this->p6;
	}
	
	public function setP6(?bool $p6): Tool04
	{
		$this->p6 = $p6;
		return $this;
	}
	
	public function getP7(): ?bool
	{
		return $this->p7;
	}
	
	public function setP7(?bool $p7): Tool04
	{
		$this->p7 = $p7;
		return $this;
	}
	
	public function getP8(): ?bool
	{
		return $this->p8;
	}
	
	public function setP8(?bool $p8): Tool04
	{
		$this->p8 = $p8;
		return $this;
	}
	
	public function getP9(): ?bool
	{
		return $this->p9;
	}
	
	public function setP9(?bool $p9): Tool04
	{
		$this->p9 = $p9;
		return $this;
	}
	
	public function getP10(): ?bool
	{
		return $this->p10;
	}
	
	public function setP10(?bool $p10): Tool04
	{
		$this->p10 = $p10;
		return $this;
	}
	
	public function getP11(): ?bool
	{
		return $this->p11;
	}
	
	public function setP11(?bool $p11): Tool04
	{
		$this->p11 = $p11;
		return $this;
	}
	
	public function getP12(): ?bool
	{
		return $this->p12;
	}
	
	public function setP12(?bool $p12): Tool04
	{
		$this->p12 = $p12;
		return $this;
	}
	
	public function getP13(): ?bool
	{
		return $this->p13;
	}
	
	public function setP13(?bool $p13): Tool04
	{
		$this->p13 = $p13;
		return $this;
	}
	
	public function getP14(): ?bool
	{
		return $this->p14;
	}
	
	public function setP14(?bool $p14): Tool04
	{
		$this->p14 = $p14;
		return $this;
	}
	
	public function getP15(): ?bool
	{
		return $this->p15;
	}
	
	public function setP15(?bool $p15): Tool04
	{
		$this->p15 = $p15;
		return $this;
	}
	
	public function getP16(): ?bool
	{
		return $this->p16;
	}
	
	public function setP16(?bool $p16): Tool04
	{
		$this->p16 = $p16;
		return $this;
	}
	
	public function getP17(): ?bool
	{
		return $this->p17;
	}
	
	public function setP17(?bool $p17): Tool04
	{
		$this->p17 = $p17;
		return $this;
	}
	
	public function getP18(): ?bool
	{
		return $this->p18;
	}
	
	public function setP18(?bool $p18): Tool04
	{
		$this->p18 = $p18;
		return $this;
	}
	
	public function getP19(): ?bool
	{
		return $this->p19;
	}
	
	public function setP19(?bool $p19): Tool04
	{
		$this->p19 = $p19;
		return $this;
	}
	
	public function getP20(): ?bool
	{
		return $this->p20;
	}
	
	public function setP20(?bool $p20): Tool04
	{
		$this->p20 = $p20;
		return $this;
	}
	
	public function getP21(): ?bool
	{
		return $this->p21;
	}
	
	public function setP21(?bool $p21): Tool04
	{
		$this->p21 = $p21;
		return $this;
	}
	
	public function getP22(): ?bool
	{
		return $this->p22;
	}
	
	public function setP22(?bool $p22): Tool04
	{
		$this->p22 = $p22;
		return $this;
	}
	
	public function getP23(): ?bool
	{
		return $this->p23;
	}
	
	public function setP23(?bool $p23): Tool04
	{
		$this->p23 = $p23;
		return $this;
	}
	
	public function getP24(): ?bool
	{
		return $this->p24;
	}
	
	public function setP24(?bool $p24): Tool04
	{
		$this->p24 = $p24;
		return $this;
	}
	
	public function getP25(): ?bool
	{
		return $this->p25;
	}
	
	public function setP25(?bool $p25): Tool04
	{
		$this->p25 = $p25;
		return $this;
	}
	
	public function getP26(): ?bool
	{
		return $this->p26;
	}
	
	public function setP26(?bool $p26): Tool04
	{
		$this->p26 = $p26;
		return $this;
	}
	
	public function getP27(): ?bool
	{
		return $this->p27;
	}
	
	public function setP27(?bool $p27): Tool04
	{
		$this->p27 = $p27;
		return $this;
	}
	
	public function getP28(): ?bool
	{
		return $this->p28;
	}
	
	public function setP28(?bool $p28): Tool04
	{
		$this->p28 = $p28;
		return $this;
	}
	
	public function getP29(): ?bool
	{
		return $this->p29;
	}
	
	public function setP29(?bool $p29): Tool04
	{
		$this->p29 = $p29;
		return $this;
	}
	
	public function getP30(): ?bool
	{
		return $this->p30;
	}
	
	public function setP30(?bool $p30): Tool04
	{
		$this->p30 = $p30;
		return $this;
	}
	
	public function getP31(): ?bool
	{
		return $this->p31;
	}
	
	public function setP31(?bool $p31): Tool04
	{
		$this->p31 = $p31;
		return $this;
	}
	
	public function getP32(): ?bool
	{
		return $this->p32;
	}
	
	public function setP32(?bool $p32): Tool04
	{
		$this->p32 = $p32;
		return $this;
	}
	
	public function getP33(): ?bool
	{
		return $this->p33;
	}
	
	public function setP33(?bool $p33): Tool04
	{
		$this->p33 = $p33;
		return $this;
	}
	
	public function getP34(): ?bool
	{
		return $this->p34;
	}
	
	public function setP34(?bool $p34): Tool04
	{
		$this->p34 = $p34;
		return $this;
	}
	
	public function getP35(): ?bool
	{
		return $this->p35;
	}
	
	public function setP35(?bool $p35): Tool04
	{
		$this->p35 = $p35;
		return $this;
	}
	
	public function getP36(): ?bool
	{
		return $this->p36;
	}
	
	public function setP36(?bool $p36): Tool04
	{
		$this->p36 = $p36;
		return $this;
	}
	
	public function getP37(): ?bool
	{
		return $this->p37;
	}
	
	public function setP37(?bool $p37): Tool04
	{
		$this->p37 = $p37;
		return $this;
	}
	
	public function getP38(): ?bool
	{
		return $this->p38;
	}
	
	public function setP38(?bool $p38): Tool04
	{
		$this->p38 = $p38;
		return $this;
	}
	
	public function getP39(): ?bool
	{
		return $this->p39;
	}
	
	public function setP39(?bool $p39): Tool04
	{
		$this->p39 = $p39;
		return $this;
	}

	public function isResult2(): bool
	{
		return $this->result2;
	}

	public function setResult2(bool $result2): Tool04
	{
		$this->result2 = $result2;
		return $this;
	}

	public function isResult3(): bool
	{
		return $this->result3;
	}

	public function setResult3(bool $result3): Tool04
	{
		$this->result3 = $result3;
		return $this;
	}

	public function isResult4(): bool
	{
		return $this->result4;
	}

	public function setResult4(bool $result4): Tool04
	{
		$this->result4 = $result4;
		return $this;
	}

	public function isResult5(): bool
	{
		return $this->result5;
	}

	public function setResult5(bool $result5): Tool04
	{
		$this->result5 = $result5;
		return $this;
	}

	public function isResultTotal(): bool
	{
		return $this->resultTotal;
	}

	public function setResultTotal(bool $resultTotal): Tool04
	{
		$this->resultTotal = $resultTotal;
		return $this;
	}
}