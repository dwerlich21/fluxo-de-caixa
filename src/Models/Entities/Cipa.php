<?php
	
	
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="cipa")
	 */
	class Cipa
	{
		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 */
		private ?int $id = null;
		
		/**
		 * @Column(type="integer")
		 * @var int
		 */
		private int $degreeOfRisk;
		
		/**
		 * @Column(type="integer")
		 * @var int
		 */
		private int $levelOfWorkers;
		
		/**
		 * @Column(type="text")
		 * @var string
		 */
		private string $professionals;
		

		public function getId()
		{
			return $this->id;
		}

		public function getDegreeOfRisk(): int
		{
			return $this->degreeOfRisk;
		}

		public function setDegreeOfRisk(int $degreeOfRisk): Cipa
		{
			$this->degreeOfRisk = $degreeOfRisk;
			return $this;
		}

		public function getLevelOfWorkers(): int
		{
			return $this->levelOfWorkers;
		}

		public function setLevelOfWorkers(int $levelOfWorkers): Cipa
		{
			$this->levelOfWorkers = $levelOfWorkers;
			return $this;
		}

		public function getProfessionals(): string
		{
			return $this->professionals;
		}

		public function setProfessionals(string $professionals): Cipa
		{
			$this->professionals = $professionals;
			return $this;
		}
	}