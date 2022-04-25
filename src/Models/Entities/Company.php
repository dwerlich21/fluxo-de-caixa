<?php
	
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="company")
	 * @ORM @Entity(repositoryClass="App\Models\Repository\CompanyRepository")
	 */
	class Company
	{
		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 */
		private ?int $id = null;
		
		/**
		 * @Column(type="string", nullable=true)
		 */
		private string $name;
		
		/**
		 * @Column(type="integer")
		 */
		private int $representativePosition;
		
		/**
		 * @Column(type="string")
		 */
		private string $representative;
		
		/**
		 * @Column(type="string")
		 */
		private string $cnpj;

		/**
		 * @ManyToOne(targetEntity="Cnae")
		 * @JoinColumn(name="cnae", referencedColumnName="id", nullable = true)
		 * @var Cnae|null
		 */
		private ?Cnae $cnae = null;
		
		/**
		 * @Column(type="integer")
		 */
		private int $numbersOfWorkers;
		
		/**
		 * @Column(type="string", nullable=true)
		 */
		private ?string $zipCode = '';
		
		/**
		 * @Column(type="string")
		 */
		private string $state;
		
		/**
		 * @Column(type="string")
		 */
		private string $city;
		
		/**
		 * @Column(type="string")
		 */
		private string $neighborhood;
		
		/**
		 * @Column(type="string")
		 */
		private string $address;
		
		/**
		 * @Column(type="string", nullable=true)
		 */
		private ?string $logoCompanyFile = '';
		
		/**
		 * @Column(type="string")
		 */
		private string $number;
		
		/**
		 * @Column(type="string", nullable=true)
		 */
		private ?string $complement = '';
		
		/**
		 * @Column(type="boolean")
		 */
		private bool $active;
		
		/**
		 * @Column(type="text", nullable=true)
		 * @var string|null
		 */
		private ?string $obs = '';
		
		
		/**
		 * @Column(type="string", nullable=true)
		 * @var string|null
		 */
		private ?string $postage = '';
		
		/**
		 * @ManyToOne(targetEntity="User")
		 * @JoinColumn(name="responsible", referencedColumnName="id")
		 * @var User
		 */
		private User $responsible;
		
		/**
		 * @ManyToOne(targetEntity="Consultant")
		 * @JoinColumn(name="consultant", referencedColumnName="id")
		 * @var Consultant
		 */
		private Consultant $consultant;
		
		/**
		 * @Column(type="string", nullable=true)
		 * @var string|null
		 */
		private ?string $typeCompany = '';
		
		/**
		 * @Column(type="string", nullable=true)
		 * @var string|null
		 */
		private ?string $situation = '';
		
		
		/**
		 * @Column(type="string", nullable=true)
		 */
		private ?string $socialReason = '';
		
		/**
		 * @Column(type="string", nullable=true)
		 * @var string
		 */
		private ?string $phone = '';
		
		/**
		 * @Column(type="string", nullable=true)
		 * @var string
		 */
		private ?string $email = '';
		

		public function getPhone(): ?string
		{
			return $this->phone;
		}

		public function setPhone(?string $phone): Company
		{
			$this->phone = $phone;
			return $this;
		}

		public function getEmail(): ?string
		{
			return $this->email;
		}

		public function setEmail(?string $email): Company
		{
			$this->email = $email;
			return $this;
		}
		
		public function getTypeCompany(): ?string
		{
			return $this->typeCompany;
		}

		public function setTypeCompany(?string $typeCompany): Company
		{
			$this->typeCompany = $typeCompany;
			return $this;
		}

		public function getSituation(): ?string
		{
			return $this->situation;
		}

		public function setSituation(?string $situation): Company
		{
			$this->situation = $situation;
			return $this;
		}
		

		public function getPostage(): ?string
		{
			return $this->postage;
		}

		public function setPostage(?string $postage): Company
		{
			$this->postage = $postage;
			return $this;
		}
		
		public function getId()
		{
			return $this->id;
		}
		
		public function getName(): string
		{
			return $this->name;
		}
		
		public function setName(string $name): Company
		{
			$this->name = $name;
			return $this;
		}
		
		public function getCnpj(): string
		{
			return $this->cnpj;
		}
		
		public function setCnpj(string $cnpj): Company
		{
			$this->cnpj = $cnpj;
			return $this;
		}

		public function getCnae(): ?Cnae
		{
			return $this->cnae;
		}

		public function setCnae(?Cnae $cnae): Company
		{
			$this->cnae = $cnae;
			return $this;
		}
		
		public function getNumbersOfWorkers(): int
		{
			return $this->numbersOfWorkers;
		}
		
		public function setNumbersOfWorkers(int $numbersOfWorkers): Company
		{
			$this->numbersOfWorkers = $numbersOfWorkers;
			return $this;
		}
		
		public function getZipCode(): ?string
		{
			return $this->zipCode;
		}
		
		public function setZipCode(?string $zipCode): Company
		{
			$this->zipCode = $zipCode;
			return $this;
		}
		
		public function getState(): string
		{
			return $this->state;
		}
		
		public function setState(string $state): Company
		{
			$this->state = $state;
			return $this;
		}
		
		public function getCity(): string
		{
			return $this->city;
		}
		
		public function setCity(string $city): Company
		{
			$this->city = $city;
			return $this;
		}
		
		public function getNeighborhood(): string
		{
			return $this->neighborhood;
		}
		
		public function setNeighborhood(string $neighborhood): Company
		{
			$this->neighborhood = $neighborhood;
			return $this;
		}
		
		public function getAddress(): string
		{
			return $this->address;
		}
		
		public function setAddress(string $address): Company
		{
			$this->address = $address;
			return $this;
		}
		
		public function getLogoCompanyFile(): ?string
		{
			return $this->logoCompanyFile;
		}
		
		public function setLogoCompanyFile(?string $logoCompanyFile): Company
		{
			$this->logoCompanyFile = substr($logoCompanyFile, strrpos($logoCompanyFile, '/') + 1);
			return $this;
		}
		
		public function getResponsible(): User
		{
			return $this->responsible;
		}
		
		public function setResponsible(User $responsible): Company
		{
			$this->responsible = $responsible;
			return $this;
		}
		
		public function getActive(): bool
		{
			return $this->active;
		}
		
		public function setActive(bool $active): Company
		{
			$this->active = $active;
			return $this;
		}
		
		public function getNumber(): string
		{
			return $this->number;
		}
		
		public function setNumber(string $number): Company
		{
			$this->number = $number;
			return $this;
		}
		
		public function getComplement(): ?string
		{
			return $this->complement;
		}
		
		public function setComplement(?string $complement): Company
		{
			$this->complement = $complement;
			return $this;
		}
		
		public function getRepresentativePosition(): int
		{
			return $this->representativePosition;
		}
		
		public function getRepresentativePositionStr(): string
		{
			switch ($this->representativePosition) {
				case 1:
					return 'Proprietário';
				case 2:
					return 'Presidente';
				case 3:
					return 'Diretor Executivo';
				case 4:
					return 'Diretor Geral';
				case 5:
					return 'Chief Executive Officer - CEO';
				case 6:
					return 'Gerente Geral';
				case 7:
					return 'Preposto';
			};
		}
		
		public function setRepresentativePosition(int $representativePosition): Company
		{
			$this->representativePosition = $representativePosition;
			return $this;
		}
		
		public function getRepresentative(): ?string
		{
			return $this->representative;
		}
		
		public function setRepresentative(?string $representative): Company
		{
			$this->representative = $representative;
			return $this;
		}
		
		public function getSocialReason(): ?string
		{
			return $this->socialReason;
		}
		
		public function setSocialReason(?string $socialReason): Company
		{
			$this->socialReason = $socialReason;
			return $this;
		}

		public function getObs(): ?string
		{
			return $this->obs;
		}

		public function setObs(?string $obs): Company
		{
			$this->obs = $obs;
			return $this;
		}

		public function getConsultant(): Consultant
		{
			return $this->consultant;
		}

		public function setConsultant(Consultant $consultant): Company
		{
			$this->consultant = $consultant;
			return $this;
		}
	}
