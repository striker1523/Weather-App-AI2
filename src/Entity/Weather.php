<?php

namespace App\Entity;

use App\Repository\WeatherRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherRepository::class)]
class Weather
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $Temperature = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $Perceived_temperature = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Date = null;

    #[ORM\Column(length: 255)]
    private ?string $City_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemperature(): ?string
    {
        return $this->Temperature;
    }

    public function setTemperature(string $Temperature): static
    {
        $this->Temperature = $Temperature;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPerceivedTemperature(): ?string
    {
        return $this->Perceived_temperature;
    }

    public function setPerceivedTemperature(string $Perceived_temperature): static
    {
        $this->Perceived_temperature = $Perceived_temperature;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->Date;
    }

    public function setDate(string $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getCityName(): ?string
    {
        return $this->City_name;
    }

    public function setCityName(string $City_name): static
    {
        $this->City_name = $City_name;

        return $this;
    }
}
