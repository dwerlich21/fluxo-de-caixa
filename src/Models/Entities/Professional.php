<?php
	
	
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="professional")
	 * @ORM @Entity(repositoryClass="App\Models\Repository\ProfessionalRepository")
	 */
	class Professional
	{
		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 */
		private ?int $id = null;
		
		/**
		 * @Column(type="string")
		 */
		private string $formation;
		
		/**
		 * @Column(type="date", nullable = true)
		 * @var \DateTime|null
		 */
		private ?\DateTime $birthDate = null;
		
		/**
		 * @Column(type="string", nullable=true)
		 */
		private ?string $professionalRecord = '';
		
		/**
		 * @Column(type="string", nullable=true)
		 * @var string|null
		 */
		private ?string $professionalAdviser = '';
		
		/**
		 * @Column(type="string", nullable=true)
		 * @var string|null
		 */
		private ?string $professionalRegistration = '';
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $cpf;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $name;
		
		/**
		 * @Column(type="boolean")
		 * @var bool
		 */
		private bool $sex;
		
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
		 * @ManyToOne(targetEntity="Environment")
		 * @JoinColumn(name="environment", referencedColumnName="id")
		 * @var Environment
		 */
		private Environment $environment;
		
		
		/**
		 * @ManyToOne(targetEntity="Company")
		 * @JoinColumn(name="company", referencedColumnName="id")
		 * @var Company
		 */
		private Company $company;
		
		/**
		 * @Column(type="date", nullable = true)
		 * @var \DateTime|null
		 */
		private ?\DateTime $admission = null;
		
		/**
		 * @Column(type="date", nullable = true)
		 * @var \DateTime|null
		 */
		private ?\DateTime $resignation = null;
		
		/**
		 * @Column(type="date", nullable = true)
		 * @var \DateTime|null
		 */
		private ?\DateTime $endInOffice = null;
		
		/**
		 * @Column(type="date", nullable = true)
		 * @var \DateTime|null
		 */
		private ?\DateTime $startInOffice = null;
		
		public function getId(): int
		{
			return $this->id;
		}
		
		public function getFormation(): string
		{
			return $this->formation;
		}
		
		public function setFormation(string $formation): Professional
		{
			$this->formation = $formation;
			return $this;
		}
		
		public function getProfessionalRecord(): ?string
		{
			return $this->professionalRecord;
		}
		
		public function setProfessionalRecord(?string $professionalRecord): Professional
		{
			$this->professionalRecord = $professionalRecord;
			return $this;
		}
		
		public function getResponsible(): User
		{
			return $this->responsible;
		}
		
		public function setResponsible(User $responsible): Professional
		{
			$this->responsible = $responsible;
			return $this;
		}
		
		public function getCompany(): Company
		{
			return $this->company;
		}
		
		public function setCompany(Company $company): Professional
		{
			$this->company = $company;
			return $this;
		}
		
		public function getProfessionalRegistration(): ?string
		{
			return $this->professionalRegistration;
		}
		
		public function setProfessionalRegistration(?string $professionalRegistration): Professional
		{
			$this->professionalRegistration = $professionalRegistration;
			return $this;
		}
		
		public function getOffice(): Office
		{
			return $this->office;
		}
		
		public function setOffice(Office $office): Professional
		{
			$this->office = $office;
			return $this;
		}
		
		public function getAdmission(): ?\DateTime
		{
			return $this->admission;
		}
		
		public function setAdmission(?\DateTime $admission): Professional
		{
			$this->admission = $admission;
			return $this;
		}
		
		public function getResignation(): ?\DateTime
		{
			return $this->resignation;
		}
		
		public function setResignation(?\DateTime $resignation): Professional
		{
			$this->resignation = $resignation;
			return $this;
		}

		public function getBirthDate(): ?\DateTime
		{
			return $this->birthDate;
		}

		public function setBirthDate(?\DateTime $birthDate): Professional
		{
			$this->birthDate = $birthDate;
			return $this;
		}

		public function getProfessionalAdviser(): ?string
		{
			return $this->professionalAdviser;
		}

		public function setProfessionalAdviser(?string $professionalAdviser): Professional
		{
			$this->professionalAdviser = $professionalAdviser;
			return $this;
		}

		public function getCpf(): string
		{
			return $this->cpf;
		}

		public function setCpf(string $cpf): Professional
		{
			$this->cpf = $cpf;
			return $this;
		}

		public function isSex(): bool
		{
			return $this->sex;
		}

		public function setSex(bool $sex): Professional
		{
			$this->sex = $sex;
			return $this;
		}

		public function getName(): string
		{
			return $this->name;
		}

		public function setName(string $name): Professional
		{
			$this->name = $name;
			return $this;
		}

		public function getEnvironment(): Environment
		{
			return $this->environment;
		}

		public function setEnvironment(Environment $environment): Professional
		{
			$this->environment = $environment;
			return $this;
		}

		public function getEndInOffice(): ?\DateTime
		{
			return $this->endInOffice;
		}

		public function setEndInOffice(?\DateTime $endInOffice): Professional
		{
			$this->endInOffice = $endInOffice;
			return $this;
		}

		public function getStartInOffice(): ?\DateTime
		{
			return $this->startInOffice;
		}

		public function setStartInOffice(?\DateTime $startInOffice): Professional
		{
			$this->startInOffice = $startInOffice;
			return $this;
		}
	}
