<?php
	
	
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="training")
	 */
	class Training
	{
		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 * @var int
		 */
		private ?int $id = null;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $training;
		
		
		public function getId(): int
		{
			return $this->id;
		}

		public function getTraining(): string
		{
			return $this->training;
		}
	}