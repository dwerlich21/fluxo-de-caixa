<?php
	
	
	namespace App\Models\Entities;
	
	/**
	 * @Entity @Table(name="environment")
	 * @ORM @Entity(repositoryClass="App\Models\Repository\EnvironmentRepository")
	 */
	class Environment
	{
		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 */
		private ?int $id = null;
		
		/**
		 * @ManyToOne(targetEntity="User")
		 * @JoinColumn(name="responsible", referencedColumnName="id")
		 * @var User
		 */
		private User $responsible;
		
		/**
		 * @ManyToOne(targetEntity="Company")
		 * @JoinColumn(name="company", referencedColumnName="id")
		 * @var Company
		 */
		private Company $company;
		
		/**
		 * @Column(type="boolean")
		 * @var bool
		 */
		private bool $active;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $name;
		
		/**
		 * @Column(type="integer")
		 * @var int
		 */
		private int $frame;
		
		/**
		 * @Column(type="integer")
		 * @var int
		 */
		private int $lining;
		
		/**
		 * @Column(type="integer")
		 * @var int
		 */
		private int $roof;
		
		/**
		 * @Column(type="integer")
		 * @var int
		 */
		private int $ventilation;
		
		/**
		 * @Column(type="integer")
		 * @var int
		 */
		private int $floor;
		
		/**
		 * @Column(type="float")
		 * @var float
		 */
		private float $area;
		
		/**
		 * @Column(type="float")
		 * @var float
		 */
		private float $rightFoot;
		
		/**
		 * @Column(type="boolean")
		 * @var bool
		 */
		private bool $establishment;
		
		/**
		 * @Column(type="string")
		 * @var string
		 */
		private string $cnpjPartner;
		
		
		public function getId()
		{
			return $this->id;
		}
		
		public function getResponsible(): User
		{
			return $this->responsible;
		}
		
		public function setResponsible(User $responsible): Environment
		{
			$this->responsible = $responsible;
			return $this;
		}
		
		public function getCompany(): Company
		{
			return $this->company;
		}
		
		public function setCompany(Company $company): Environment
		{
			$this->company = $company;
			return $this;
		}
		
		public function isActive(): bool
		{
			return $this->active;
		}
		
		public function setActive(bool $active): Environment
		{
			$this->active = $active;
			return $this;
		}
		
		public function activeStr(): string
		{
			if (1 == $this->active) {
				return "Ativo";
			}
			return "Inativo";
			
		}
		
		public function getName(): string
		{
			return $this->name;
		}
		
		public function setName(string $name): Environment
		{
			$this->name = $name;
			return $this;
		}
		
		public function getFrame(): int
		{
			return $this->frame;
		}
		
		public function getFrameStr(): string
		{
			switch($this->frame) {
				case 1:
					return 'alvenaria convencional ou de vedação';
				case 2:
					return 'alvenaria estrutural';
				case 3:
					return 'steel frame';
				case 4:
					return 'wood frame';
				case 5:
					return 'paredes de concreto';
				case 6:
					return 'container';
				case 7:
					return 'drywall';
			}
		}
		
		public function setFrame(int $frame): Environment
		{
			$this->frame = $frame;
			return $this;
		}
		
		public function getLining(): int
		{
			return $this->lining;
		}
		
		public function getLiningStr(): string
		{
			switch($this->lining) {
				case 1:
					return 'sem forro';
				case 2:
					return 'forrado com PVC';
				case 3:
					return 'forrado com gesso';
				case 4:
					return 'forrado com gesso acartonado';
				case 5:
					return 'forrado com madeira';
				case 6:
					return 'forrado com lã de vidro';
				case 7:
					return 'com forro modular';
				case 8:
					return 'com forro de isopor com textura';
				case 9:
					return 'forrado com bambu';
				case 10:
					return 'forrado com concreto aparente';
				case 11:
					return 'fibra mineral acústica';
			}
		}
		
		public function setLining(int $lining): Environment
		{
			$this->lining = $lining;
			return $this;
		}
		
		public function getRoof(): int
		{
			return $this->roof;
		}
		
		public function getRoofStr(): string
		{
			switch($this->roof) {
				case 1:
					return 'sem cobertura';
				case 2:
					return 'laje maciça';
				case 3:
					return 'laje nervurada';
				case 4:
					return 'laje protendida';
				case 5:
					return 'laje pré-fabricada com poliestireno (isopor)';
				case 6:
					return 'laje pré-fabricada de cerâmica';
				case 7:
					return 'laje pré-fabricada de painéis treliçados';
				case 8:
					return 'telha de cerâmica';
				case 9:
					return 'telha de fibrocimento';
				case 10:
					return 'telhas metálicas';
				case 11:
					return 'telha de polímero';
				case 12:
					return 'telha de vidro';
				case 13:
					return 'telhas termoacústicas';
				case 14:
					return 'membranas (lonas)';
				case 15:
					return 'toldo';
				case 16:
					return 'pergolado';
				case 17:
					return 'vegetal rústico (sapé)';
			}
		}
		
		public function setRoof(int $roof): Environment
		{
			$this->roof = $roof;
			return $this;
		}
		
		public function getArea(): float
		{
			return $this->area;
		}
		
		public function setArea(float $area): Environment
		{
			$this->area = $area;
			return $this;
		}
		
		public function getVentilation(): int
		{
			return $this->ventilation;
		}
		
		public function getVentilationStr(): string
		{
			switch($this->ventilation) {
				case 1:
					return 'sem ventilação';
				case 2:
					return 'ventilação natural';
				case 3:
					return 'ventilação por central no teto';
				case 4:
					return 'ventilação por central na parede';
				case 5:
					return 'ventilação por ventilador';
				case 6:
					return 'ventilação geral diluidora';
				case 7:
					return 'ventilação exaustora';
				case 8:
					return 'ventilação por pressão negativa';
			}
		}
		
		public function setVentilation(int $ventilation): Environment
		{
			$this->ventilation = $ventilation;
			return $this;
		}
		
		public function getRightFoot(): float
		{
			return $this->rightFoot;
		}
		
		public function setRightFoot(float $rightFoot): Environment
		{
			$this->rightFoot = $rightFoot;
			return $this;
		}
		
		public function getFloor(): int
		{
			return $this->floor;
		}
		
		public function getFloorStr(): string
		{
			switch($this->floor) {
				case 1:
					return 'não pavimentado';
				case 2:
					return 'piso de cimento';
				case 3:
					return 'piso de cimento queimado';
				case 4:
					return 'piso de cerâmica';
				case 5:
					return 'piso de porcelanato';
				case 6:
					return 'piso de mármore';
				case 7:
					return 'piso de granito';
				case 8:
					return 'piso de laminado de madeira';
				case 9:
					return 'assoalho de madeira';
				case 10:
					return 'piso de vinílico';
				case 11:
					return 'piso de ladrilho hidráulico';
			}
		}
		
		public function setFloor(int $floor): Environment
		{
			$this->floor = $floor;
			return $this;
		}
		
		public function isEstablishment(): bool
		{
			return $this->establishment;
		}
		
		public function setEstablishment(bool $establishment): Environment
		{
			$this->establishment = $establishment;
			return $this;
		}

		public function getCnpjPartner(): string
		{
			return $this->cnpjPartner;
		}

		public function setCnpjPartner(string $cnpjPartner): Environment
		{
			$this->cnpjPartner = $cnpjPartner;
			return $this;
		}
	}
