<?php
	
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="officeActivity")
	 * @ORM @Entity(repositoryClass="App\Models\Repository\OfficeActivityRepository")
	 */
	class OfficeActivity
	{
		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 * @var int
		 */
		private int $id;
		
		/**
		 * @Column(type="text")
		 * @var string
		 */
		private string $activity;
		
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
		 * @Column(type="boolean", options={"default" : 1})
		 * @var bool
		 */
		private bool $active;
		
		public function getId(): int
		{
			return $this->id;
		}
		
		public function getActivity(): string
		{
			return $this->activity;
		}
		
		public function setActivity(string $activity): OfficeActivity
		{
			$this->activity = $activity;
			return $this;
		}
		
		public function getResponsible(): User
		{
			return $this->responsible;
		}
		
		public function setResponsible(User $responsible): OfficeActivity
		{
			$this->responsible = $responsible;
			return $this;
		}
		
		public function getOffice(): Office
		{
			return $this->office;
		}
		
		public function setOffice(Office $office): OfficeActivity
		{
			$this->office = $office;
			return $this;
		}

		public function isActive(): bool
		{
			return $this->active;
		}

		public function setActive(bool $active): OfficeActivity
		{
			$this->active = $active;
			return $this;
		}
	}
