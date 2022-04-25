<?php

namespace App\Models\Entities;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
/**
 * @Entity @Table(name="dangerTool")
 * @ORM @Entity(repositoryClass="App\Models\Repository\DangerToolRepository")
 */
class DangerTool
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
	 * @Column(type="integer")
	 * @var int
	 */
	private int $tool;
	
	/**
	 * @Column(type="boolean")
	 * @var bool
	 */
	private bool $active;
	

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getDanger(): Danger
	{
		return $this->danger;
	}

	public function setDanger(Danger $danger): DangerTool
	{
		$this->danger = $danger;
		return $this;
	}

	public function getTool(): int
	{
		return $this->tool;
	}

	public function setTool(int $tool): DangerTool
	{
		$this->tool = $tool;
		return $this;
	}

	public function isActive(): bool
	{
		return $this->active;
	}

	public function setActive(bool $active): DangerTool
	{
		$this->active = $active;
		return $this;
	}
}