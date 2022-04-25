<?php


namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="dangerGes")
 * @ORM @Entity(repositoryClass="App\Models\Repository\DangerGesRepository")
 */
class DangerGes
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
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
	 * @ManyToOne(targetEntity="Office")
	 * @JoinColumn(name="ges", referencedColumnName="id")
	 * @var Office
	 */
	private Office $ges;
	
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $active;
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getCompany(): Company
	{
		return $this->company;
	}
	
	public function setCompany(Company $company): DangerGes
	{
		$this->company = $company;
		return $this;
	}
	
	public function getDanger(): Danger
	{
		return $this->danger;
	}
	
	public function setDanger(Danger $danger): DangerGes
	{
		$this->danger = $danger;
		return $this;
	}
	
	public function getGes(): Office
	{
		return $this->ges;
	}
	
	public function setGes(Office $ges): DangerGes
	{
		$this->ges = $ges;
		return $this;
	}
	
	public function isActive(): bool
	{
		return $this->active;
	}
	
	public function setActive(bool $active): DangerGes
	{
		$this->active = $active;
		return $this;
	}
}