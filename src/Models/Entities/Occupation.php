<?php
	
	
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="occupation")
	 */
	class Occupation
	{
		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 * @var int
		 */
		private ?int $id = null;
		
		/**
		 * @Column(type="integer")
		 * @var int
		 */
		private int $cod;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $occupation;
		

		public function getId(): int
		{
			return $this->id;
		}

		public function setId(int $id): Occupation
		{
			$this->id = $id;
			return $this;
		}

		public function getOccupation(): string
		{
			return $this->occupation;
		}

		public function setOccupation(string $occupation): Occupation
		{
			$this->occupation = $occupation;
			return $this;
		}

		public function getCod(): int
		{
			return $this->cod;
		}

		public function setCod(int $cod): Occupation
		{
			$this->cod = $cod;
			return $this;
		}
	}