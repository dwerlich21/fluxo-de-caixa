<?php

namespace App\Models\Entities;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="client")
 * @ORM @Entity(repositoryClass="App\Models\Repository\ClientRepository")
 */
class Client
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
	/**
	 * @Column(type="string")
	 */
	private string $phone;
	
	/**
	 * @Column(type="string")
	 */
	private string $country;
	
	/**
	 * @Column(type="string")
	 */
	private string $city;
	

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getPhone(): string
	{
		return $this->phone;
	}

	public function setPhone(string $phone): Client
	{
		$this->phone = $phone;
		return $this;
	}

	public function getCity(): string
	{
		return $this->city;
	}

	public function setCity(string $city): Client
	{
		$this->city = $city;
		return $this;
	}

	public function getCountry(): string
	{
		return $this->country;
	}

	public function setCountry(string $country): Client
	{
		$this->country = $country;
		return $this;
	}
}