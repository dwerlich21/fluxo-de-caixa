<?php
	
	
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="paymentPlan")
	 * @ORM @Entity(repositoryClass="App\Models\Repository\PaymentPlanRepository")
	 */
	class PaymentPlan
	{
		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 * @var int
		 */
		private int $id;
		
		/**
		 * @ManyToOne(targetEntity="Consultant")
		 * @JoinColumn(name="consultant", referencedColumnName="id")
		 * @var Consultant
		 */
		private Consultant $consultant;
		
		/**
		 * @Column(type="datetime")
		 * @var \DateTime
		 */
		private \DateTime $created;
		
		public function __construct()
		{
			$this->created = new \DateTime();
		}
		
		public function getId(): int
		{
			return $this->id;
		}
		
		public function getConsultant(): Consultant
		{
			return $this->consultant;
		}

		public function setConsultant(Consultant $consultant): PaymentPlan
		{
			$this->consultant = $consultant;
			return $this;
		}
	}