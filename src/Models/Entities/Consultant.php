<?php
	
	
	namespace App\Models\Entities;
	
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @Entity @Table(name="consultant")
	 * @ORM @Entity(repositoryClass="App\Models\Repository\ConsultantRepository")
	 */
	class Consultant
	{
		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 * @var int
		 */
		private int $id;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $name;
		
		/**
		 * @Column(type="string", nullable = true)
		 * @var string|null
		 */
		private ?string $cnpj = null;
		
		/**
		 * @Column(type="string", nullable = true)
		 * @var string|null
		 */
		private ?string $cpf = null;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $zipCode;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $state;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $city;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $phone;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $address;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $neighborhood;
		
		/**
		 * @Column(type="string", nullable=true)
		 * @var string|null
		 */
		private ?string $complement = '';
		
		/**
		 * @Column(type="string")
		 * @var string|null
		 */
		private string $number;
		
		/**
		 * @Column(type="string", nullable = true)
		 * @var string|null
		 */
		private ?string $logoConsultantFile = '';
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $email;
		

		public function getId(): int
		{
			return $this->id;
		}

		public function getName(): string
		{
			return $this->name;
		}

		public function setName(string $name): Consultant
		{
			$this->name = $name;
			return $this;
		}

		public function getCnpj(): ?string
		{
			return $this->cnpj;
		}

		public function setCnpj(?string $cnpj): Consultant
		{
			$this->cnpj = $cnpj;
			return $this;
		}

		public function getCpf(): ?string
		{
			return $this->cpf;
		}

		public function setCpf(?string $cpf): Consultant
		{
			$this->cpf = $cpf;
			return $this;
		}

		public function getZipCode(): string
		{
			return $this->zipCode;
		}

		public function setZipCode(string $zipCode): Consultant
		{
			$this->zipCode = $zipCode;
			return $this;
		}

		public function getState(): string
		{
			return $this->state;
		}

		public function setState(string $state): Consultant
		{
			$this->state = $state;
			return $this;
		}

		public function getCity(): string
		{
			return $this->city;
		}

		public function setCity(string $city): Consultant
		{
			$this->city = $city;
			return $this;
		}

		public function getPhone(): string
		{
			return $this->phone;
		}

		public function setPhone(string $phone): Consultant
		{
			$this->phone = $phone;
			return $this;
		}

		public function getAddress(): string
		{
			return $this->address;
		}

		public function setAddress(string $address): Consultant
		{
			$this->address = $address;
			return $this;
		}

		public function getNeighborhood(): string
		{
			return $this->neighborhood;
		}

		public function setNeighborhood(string $neighborhood): Consultant
		{
			$this->neighborhood = $neighborhood;
			return $this;
		}

		public function getComplement(): ?string
		{
			return $this->complement;
		}

		public function setComplement(?string $complement): Consultant
		{
			$this->complement = $complement;
			return $this;
		}

		public function getNumber(): ?string
		{
			return $this->number;
		}

		public function setNumber(?string $number): Consultant
		{
			$this->number = $number;
			return $this;
		}

		public function getLogoConsultantFile(): ?string
		{
			return $this->logoConsultantFile;
		}

		public function setLogoConsultantFile(?string $logoConsultantFile): Consultant
		{
			$this->logoConsultantFile = substr($logoConsultantFile, strrpos($logoConsultantFile, '/') + 1);
			return $this;
		}

		public function getEmail(): string
		{
			return $this->email;
		}

		public function setEmail(string $email): Consultant
		{
			$this->email = $email;
			return $this;
		}
	}