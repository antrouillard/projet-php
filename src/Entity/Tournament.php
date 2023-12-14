<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Repository\TournamentRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
#[ORM\Table(name: 'tournaments')]
class Tournament
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $tournamentId = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'The name of your tournament must be at least {{ limit }} characters long',
        maxMessage: 'The name of your tournament cannot be longer than {{ limit }} characters',
    )]
    private string $tournamentName;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'The email must be at least {{ limit }} characters long',
        maxMessage: 'The email cannot be longer than {{ limit }} characters',
    )]
    private string $tournamentEmail;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private string $tournamentStartDate;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private string $tournamentEndDate;


    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private int $nb_slots;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    private float $entry_price;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 1000,
        minMessage: 'The rules must be at least {{ limit }} characters long',
        maxMessage: 'The rules of your tournament cannot be longer than {{ limit }} characters',
    )]
    private string $rules;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 1000,
        minMessage: 'The adress must be at least {{ limit }} characters long',
        maxMessage: 'The adress of your tournament cannot be longer than {{ limit }} characters',
    )]
    private string $adress;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    private float $prize_money;


    public function getTournamentId(): ?int
    {
        return $this->tournamentId;
    }

    public function setTournamentId(?int $tournamentId): Tournament
    {
        $this->tournamentId = $tournamentId;
        return $this;
    }

    public function getName(): string
    {
        return $this->tournamentName;
    }

    public function setTournamentName(string $tournamentName): Tournament
    {
        $this->tournamentName = $tournamentName;
        return $this;
    }

    public function getTournamentEmail(): string
    {
        return $this->tournamentEmail;
    }

    public function setTournamentEmail(string $tournamentEmail): Tournament
    {
        $this->tournamentEmail = $tournamentEmail;
        return $this;
    }

    public function getTournamentStartDate(): string
    {
        return $this->tournamentStartDate;
    }

    public function setTournamentStartDate(string $tournamentStartDate): Tournament
    {
        $this->tournamentStartDate = $tournamentStartDate;
        return $this;
    }

    public function getTournamentEndDate(): string
    {
        return $this->tournamentEndDate;
    }

    public function setTournamentEndDate(string $tournamentStartDate): Tournament
    {
        $this->tournamentStartDate = $tournamentStartDate;
        return $this;
    }

    public function getNbSlots(): ?int
    {
        return $this->nb_slots;
    }

    public function setNbSlots(?int $nb_slots): Tournament
    {
        $this->nb_slots = $nb_slots;
        return $this;
    }

    public function getEntryPrice(): ?float
    {
        return $this->entry_price;
    }

    public function setEntryPrice(?float $entry_price): Tournament
    {
        return $this;
    }

    public function setRules(string $rules): Tournament
    {
        $this->rules = $rules;
        return $this;
    }

    public function getRules(): string
    {
        return $this->rules;
    }

    public function setAdress(string $adress): Tournament
    {
        $this->adress = $adress;
        return $this;
    }

    public function getAdress(): string
    {
        return $this->adress;
    }

    public function getPrize_money(): ?float
    {
        return $this->prize_money;
    }

    public function setPrize_money(?float $prize_money): Tournament
    {
        $this->prize_money = $prize_money;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('%s', $this->tournamentName);
    }
}