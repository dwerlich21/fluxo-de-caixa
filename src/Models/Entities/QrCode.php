<?php

namespace App\Models\Entities;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="qrCode")
 * @ORM @Entity(repositoryClass="App\Models\Repository\QrCodeRepository")
 */
class QrCode
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
	 * @ManyToOne(targetEntity="Office")
	 * @JoinColumn(name="office", referencedColumnName="id")
	 * @var Office
	 */
	private Office $office;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private string $img;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private string $token;
	
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

	public function setDanger(Danger $danger): QrCode
	{
		$this->danger = $danger;
		return $this;
	}

	public function getOffice(): Office
	{
		return $this->office;
	}

	public function setOffice(Office $office): QrCode
	{
		$this->office = $office;
		return $this;
	}

	public function getImg(): string
	{
		return $this->img;
	}

	public function setImg(string $img): QrCode
	{
		$this->img = $img;
		return $this;
	}

	public function getToken(): string
	{
		return $this->token;
	}

	public function setToken(string $token): QrCode
	{
		$this->token = $token;
		return $this;
	}

	public function isActive(): bool
	{
		return $this->active;
	}

	public function setActive(bool $active): QrCode
	{
		$this->active = $active;
		return $this;
	}
}