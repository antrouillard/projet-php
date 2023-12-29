<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Repository\TeamRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Entity\User; 

#[ORM\Entity(repositoryClass: TeamRepository::class)]
#[ORM\Table(name: 'teams')]

class Team extends Participant
{

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your team name must be at least {{ limit }} characters long',
        maxMessage: 'Your team name cannot be longer than {{ limit }} characters',
    )]
    private string $name;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private string $playersNames;

    #[ORM\Column(type: 'string')]
    #[Assert\NotNull]
    private string $img_path;

    #[ORM\Column(type: 'string')]
    #[Assert\NotNull]
    private string $niveau;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Team
    {
        $this->name = $name;
        return $this;
    }


    public function getNiveau(): string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): Team
    {
        $this->niveau = $niveau;
        return $this;
    }

    public function getPlayersNames(): string
    {
        return $this->playersNames;
    }

    public function setPlayersNames(string $playersNames): Team
    {
        $this->playersNames = $playersNames;
        return $this;
    }

    public function getImgPath() : string
    {
        return $this->img_path;
    }

    public function setImgPath(string $img_path): Team
    {
        $this->img_path = $img_path;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('%s %s', $this->name, $this->niveau);
    }

}