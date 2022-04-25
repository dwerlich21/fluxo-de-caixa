<?php
	
	
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="epi")
	 */
	class Epi
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
		private string $epi;
		

		public function getId(): int
		{
			return $this->id;
		}

		public function getEpi(): string
		{
			return $this->epi;
		}
	}