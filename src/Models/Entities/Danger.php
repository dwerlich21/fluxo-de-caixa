<?php


namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="danger")
 * @ORM @Entity(repositoryClass="App\Models\Repository\DangerRepository")
 */
class Danger
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
	 * @ManyToOne(targetEntity="Environment")
	 * @JoinColumn(name="environment", referencedColumnName="id")
	 * @var Environment
	 */
	private Environment $environment;
	
	/**
	 * @Column(type="text", nullable=true)
	 * @var string|null
	 */
	private ?string $post = null;
	
	/**
	 * @Column(type="text", nullable=true)
	 * @var string|null
	 */
	private ?string $activity = null;
	
	/**
	 * @ManyToOne(targetEntity="DangerErgonomic")
	 * @JoinColumn(name="danger", referencedColumnName="id", nullable=true)
	 * @var DangerErgonomic
	 */
	private DangerErgonomic $danger;
	
	/**
	 * @ManyToOne(targetEntity="Risk")
	 * @JoinColumn(name="risk", referencedColumnName="id", nullable=true)
	 * @var Risk
	 */
	private Risk $risk;
	
	/**
	 * @ManyToOne(targetEntity="Process")
	 * @JoinColumn(name="process", referencedColumnName="id", nullable=true)
	 * @var Process
	 */
	private Process $process;
	
	/**
	 * @Column(type="text")
	 * @var string
	 */
	private string $source;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $frequency;
	
	/**
	 * @Column(type="text")
	 * @var string
	 */
	private string $prevention;
	
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $status;
	
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $byPost;
	
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $byActivity;
	
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getResponsible(): User
	{
		return $this->responsible;
	}
	
	public function setResponsible(User $responsible): Danger
	{
		$this->responsible = $responsible;
		return $this;
	}
	
	public function getCompany(): Company
	{
		return $this->company;
	}
	
	public function setCompany(Company $company): Danger
	{
		$this->company = $company;
		return $this;
	}
	
	public function getEnvironment(): Environment
	{
		return $this->environment;
	}
	
	public function setEnvironment(Environment $environment): Danger
	{
		$this->environment = $environment;
		return $this;
	}
	
	public function getGes(): Office
	{
		return $this->ges;
	}
	
	public function setGes(Office $ges): Danger
	{
		$this->ges = $ges;
		return $this;
	}
	
	public function getPost(): ?string
	{
		return $this->post;
	}
	
	public function setPost(?string $post): Danger
	{
		$this->post = $post;
		return $this;
	}
	
	public function getActivity(): ?string
	{
		return $this->activity;
	}
	
	public function setActivity(?string $activity): Danger
	{
		$this->activity = $activity;
		return $this;
	}
	
	public function getDanger(): DangerErgonomic
	{
		return $this->danger;
	}
	
	public function setDanger(DangerErgonomic $danger): Danger
	{
		$this->danger = $danger;
		return $this;
	}
	
	public function getProcess(): Process
	{
		return $this->process;
	}
	
	public function setProcess(Process $process): Danger
	{
		$this->process = $process;
		return $this;
	}
	
	public function getSource(): string
	{
		return $this->source;
	}
	
	public function setSource(string $source): Danger
	{
		$this->source = $source;
		return $this;
	}
	
	public function getFrequency(): int
	{
		return $this->frequency;
	}
	
	
	
	public function setFrequency(int $frequency): Danger
	{
		$this->frequency = $frequency;
		return $this;
	}
	
	public function getFrequencyStr(): string
	{
		switch ($this->frequency) {
			case 1:
				return 'Eventual';
			case 2:
				return '12h/dia';
			case 3:
				return '8h/dia';
			case 4:
				return '6h/dia';
			case 5:
				return '4h/dia';
			case 6:
				return '2h/dia';
		}
	}
	
	public function getPrevention(): string
	{
		return $this->prevention;
	}
	
	public function setPrevention(string $prevention): Danger
	{
		$this->prevention = $prevention;
		return $this;
	}
	
	public function isStatus(): bool
	{
		return $this->status;
	}
	
	public function setStatus(bool $status): Danger
	{
		$this->status = $status;
		return $this;
	}
	
	public function isByPost(): bool
	{
		return $this->byPost;
	}
	
	public function setByPost(bool $byPost): Danger
	{
		$this->byPost = $byPost;
		return $this;
	}
	
	public function isByActivity(): bool
	{
		return $this->byActivity;
	}
	
	public function setByActivity(bool $byActivity): Danger
	{
		$this->byActivity = $byActivity;
		return $this;
	}

	public function getRisk(): Risk
	{
		return $this->risk;
	}

	public function setRisk(Risk $risk): Danger
	{
		$this->risk = $risk;
		return $this;
	}
}
