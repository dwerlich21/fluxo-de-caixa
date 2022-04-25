<?php
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="officeTraining")
	 * @ORM @Entity(repositoryClass="App\Models\Repository\OfficeTrainingRepository")
	 */
	class OfficeTraining
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
		 * @ManyToOne(targetEntity="Training")
		 * @JoinColumn(name="training", referencedColumnName="id")
		 * @var Training
		 */
		private Training $training;
		
		/**
		 * @Column(type="boolean", options={"default" : 1})
		 * @var bool
		 */
		private bool $active;
		
		public function getId(): int
		{
			return $this->id;
		}
		
		public function getResponsible(): User
		{
			return $this->responsible;
		}
		
		public function setResponsible(User $responsible): OfficeTraining
		{
			$this->responsible = $responsible;
			return $this;
		}
		
		public function getOffice(): Office
		{
			return $this->office;
		}
		
		public function setOffice(Office $office): OfficeTraining
		{
			$this->office = $office;
			return $this;
		}

		public function getTraining(): Training
		{
			return $this->training;
		}

		public function setTraining(Training $training): OfficeTraining
		{
			$this->training = $training;
			return $this;
		}

		public function isActive(): bool
		{
			return $this->active;
		}

		public function setActive(bool $active): OfficeTraining
		{
			$this->active = $active;
			return $this;
		}
	}
