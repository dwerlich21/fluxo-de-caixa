<?php


namespace App\Models\Entities;

/**
 * @Entity @Table(name="environmentLightSource")
 * @ORM @Entity(repositoryClass="App\Models\Repository\EnvironmentLightSourceRepository")
 */
class EnvironmentLightSource
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
	 * @ManyToOne(targetEntity="Environment")
	 * @JoinColumn(name="environment", referencedColumnName="id")
	 * @var Environment
	 */
	private Environment $environment;
	
	/**
	 * @Column(type="integer")
	 * @var int
	 */
	private int $lightSource;
	
	/**
	 * @Column(type="boolean", options={"default" : 1})
	 * @var bool
	 */
	private bool $active;
	
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getResponsible(): User
	{
		return $this->responsible;
	}
	
	public function setResponsible(User $responsible): EnvironmentLightSource
	{
		$this->responsible = $responsible;
		return $this;
	}
	
	public function getEnvironment(): Environment
	{
		return $this->environment;
	}
	
	public function setEnvironment(Environment $environment): EnvironmentLightSource
	{
		$this->environment = $environment;
		return $this;
	}
	
	public function getLightSource(): int
	{
		return $this->lightSource;
	}
	
	public function getLightSourceStr(): string
	{
		switch ($this->lightSource) {
			case 1:
				return 'luz natural (Sol)';
			case 2:
				return 'lâmpada incandescente convencional';
			case 3:
				return 'lâmpada incandescente halógena';
			case 4:
				return 'lâmpada fluorescente';
			case 5:
				return 'lâmpada LED';
			case 6:
				return 'lâmpada de fibra ótica';
			case 7:
				return 'lâmpada de descarga';
			case 8:
				return 'lâmpada de neon';
		}
	}
	
	public function setLightSource(int $lightSource): EnvironmentLightSource
	{
		$this->lightSource = $lightSource;
		return $this;
	}
	
	public function isActive(): bool
	{
		return $this->active;
	}
	
	public function setActive(bool $active): EnvironmentLightSource
	{
		$this->active = $active;
		return $this;
	}
}