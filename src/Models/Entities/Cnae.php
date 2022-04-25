<?php
	
	
	namespace App\Models\Entities;
	
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="cnae")
	 */
	class Cnae
	{
		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 */
		private ?int $id = null;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $cnae;
		
		/**
		 * @Column(type="string", nullable=true)
		 * @var string
		 */
		private ?string $description = '';
		
		/**
		 * @Column(type="integer", nullable=true)
		 *  @var int
		 */
		private int $riskCnae;
		

		public function getId()
		{
			return $this->id;
		}

		public function getCnae(): string
		{
			return $this->cnae;
		}

		public function setCnae(string $cnae): Cnae
		{
			$this->cnae = $cnae;
			return $this;
		}

		public function getGroupCnae(): ?string
		{
			return $this->groupCnae;
		}

		public function setGroupCnae(?string $groupCnae): Cnae
		{
			$this->groupCnae = $groupCnae;
			return $this;
		}

		public function getRiskCnae(): int
		{
			return $this->riskCnae;
		}

		public function setRiskCnae(int $riskCnae): Cnae
		{
			$this->riskCnae = $riskCnae;
			return $this;
		}

		public function getDescription(): string
		{
			return $this->description;
		}

		public function setDescription(string $description): Cnae
		{
			$this->description = $description;
			return $this;
		}
	}