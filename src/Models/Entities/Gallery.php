<?php

namespace App\Models\Entities;
use App\Helpers\Utils;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Console\Tester\ApplicationTester;

/**
 * @Entity @Table(name="gallery")
 * @ORM @Entity(repositoryClass="App\Models\Repository\GalleryRepository")
 */
class Gallery
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
	/**
	 * @Column(type="string")
	 */
	private string $imgFile;
	
	/**
	 * @Column(type="string")
	 */
	private string $name;
	
	/**
	 * @ManyToOne(targetEntity="Consultant")
	 * @JoinColumn(name="consultant", referencedColumnName="id")
	 */
	private Consultant $consultant;
	
	/**
	 * @Column(type="boolean")
	 */
	private bool $status;
	

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getImgFile(): string
	{
		return $this->imgFile;
	}

	public function setImgFile(string $imgFile): Gallery
	{
		$this->imgFile = substr($imgFile, strrpos($imgFile, '/') + 1);
		return $this;
	}

	public function getConsultant(): Consultant
	{
		return $this->consultant;
	}

	public function setConsultant(Consultant $consultant): Gallery
	{
		$this->consultant = $consultant;
		return $this;
	}

	public function isStatus(): bool
	{
		return $this->status;
	}

	public function setStatus(bool $status): Gallery
	{
		$this->status = $status;
		return $this;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): Gallery
	{
		$this->name = $name;
		return $this;
	}
}