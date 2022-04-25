<?php
	
	
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="occupationLargeArea")
	 */
	class OccupationLargeArea
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
		private string $largeArea;

		public function getId(): int
		{
			return $this->id;
		}

		public function getCod(): int
		{
			return $this->cod;
		}

		public function getLargeArea(): string
		{
			return $this->largeArea;
		}
	}