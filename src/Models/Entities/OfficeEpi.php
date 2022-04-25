<?php
	
	
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="officeEpi")
	 * @ORM @Entity(repositoryClass="App\Models\Repository\OfficeEpiRepository")
	 */
	class OfficeEpi
	{
		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 * @var int
		 */
		private int $id;
		
		/**
		 * @ManyToOne(targetEntity="User")
		 * @JoinColumn(name="responsible", referencedColumnName="id")
		 * @var User
		 */
		private User $responsible;
		
		/**
		 * @ManyToOne(targetEntity="Office")
		 * @JoinColumn(name="office", referencedColumnName="id")
		 * @var Office
		 */
		private Office $office;
		
		/**
		 * @ManyToOne(targetEntity="Epi")
		 * @JoinColumn(name="epi", referencedColumnName="id")
		 * @var Epi
		 */
		private Epi $epi;
		
		/**
		 * @Column(type="boolean", options={"default" : 1})
		 * @var bool
		 */
		private bool $active;
		

		public function getId(): int
		{
			return $this->id;
		}

		public function setId(int $id): OfficeEpi
		{
			$this->id = $id;
			return $this;
		}

		public function getResponsible(): User
		{
			return $this->responsible;
		}

		public function setResponsible(User $responsible): OfficeEpi
		{
			$this->responsible = $responsible;
			return $this;
		}

		public function getOffice(): Office
		{
			return $this->office;
		}

		public function setOffice(Office $office): OfficeEpi
		{
			$this->office = $office;
			return $this;
		}

		public function getEpi(): Epi
		{
			return $this->epi;
		}

		public function setEpi(Epi $epi): OfficeEpi
		{
			$this->epi = $epi;
			return $this;
		}

		public function isActive(): bool
		{
			return $this->active;
		}

		public function setActive(bool $active): OfficeEpi
		{
			$this->active = $active;
			return $this;
		}
	}