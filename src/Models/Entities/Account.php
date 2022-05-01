<?php

namespace App\Models\Entities;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="account")
 * @ORM @Entity(repositoryClass="App\Models\Repository\AccountRepository")
 */
class Account
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
	/**
	 * @Column(type="string")
	 */
	private string $name;
	
	/**
	 * @Column(type="boolean")
	 */
	private bool $active;
	

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): Account
	{
		$this->name = $name;
		return $this;
	}

	public function isActive(): bool
	{
		return $this->active;
	}

	public function setActive(bool $active): Account
	{
		$this->active = $active;
		return $this;
	}
	
	public function activeStr(): string
	{
		if (1 == $this->active) {
			return "Ativo";
		}
		return "Inativo";
		
	}
}