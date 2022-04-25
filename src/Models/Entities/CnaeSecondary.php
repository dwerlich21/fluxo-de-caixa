<?php
	
	
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="cnaeSecondary")
	 * @ORM @Entity(repositoryClass="App\Models\Repository\CnaeSecondaryRepository")
	 */
	class CnaeSecondary
	{
		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 */
		private ?int $id = null;
		
		/**
		 * @ManyToOne(targetEntity="Cnae")
		 * @JoinColumn(name="cnae", referencedColumnName="id")
		 * @var Cnae
		 */
		private Cnae $cnae;
		
		/**
		 * @ManyToOne(targetEntity="Company")
		 * @JoinColumn(name="company", referencedColumnName="id")
		 * @var Company
		 */
		private Company $company;
		
		/**
		 * @Column(type="boolean", options={"default" : 1})
		 * @var bool
		 */
		private bool $active;

		public function getId()
		{
			return $this->id;
		}

		public function setId($id)
		{
			$this->id = $id;
			return $this;
		}

		public function getCnae(): Cnae
		{
			return $this->cnae;
		}

		public function setCnae(Cnae $cnae): CnaeSecondary
		{
			$this->cnae = $cnae;
			return $this;
		}

		public function getCompany(): Company
		{
			return $this->company;
		}

		public function setCompany(Company $company): CnaeSecondary
		{
			$this->company = $company;
			return $this;
		}

		public function isActive(): bool
		{
			return $this->active;
		}

		public function setActive(bool $active): CnaeSecondary
		{
			$this->active = $active;
			return $this;
		}
	}