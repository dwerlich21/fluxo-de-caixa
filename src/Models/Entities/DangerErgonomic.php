<?php


namespace App\Models\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="dangerErgonomic")
 */
class DangerErgonomic
{
	/**
	 * @Id @GeneratedValue @Column(type="integer")
	 */
	private ?int $id = null;
	
	/**
	 * @Column(type="text")
	 * @var string
	 */
	private string $name;
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getName(): string
	{
		return $this->name;
	}
	
	public function setName(string $name): DangerErgonomic
	{
		$this->name = $name;
		return $this;
	}
}
