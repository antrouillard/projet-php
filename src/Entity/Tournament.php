<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Repository\TournamentRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
#[ORM\Table(name: 'tournaments')]
class Tournament
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your name must be at least {{ limit }} characters long',
        maxMessage: 'Your name cannot be longer than {{ limit }} characters',
    )]
    private string $name;

    #[ORM\Column(type: 'integer')]
    //#[Assert\NotBlank]
    private int $entryPrice;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    private string $rules;

    
    #[ORM\Column(type: 'date')]
    #[Assert\NotNull]
    private ?DateTime $startDate;


    #[ORM\Column(type: 'date')]
    #[Assert\NotNull]
    private ?DateTime $endDate;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotNull]
    private int $nbSlots;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotNull]
    private int $nbSlotsTaken;

    #[ORM\Column(type: 'string')]
    #[Assert\NotNull]
    private string $mail;

    #[ORM\Column(type: 'string')]
    #[Assert\NotNull]
    private string $adress;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotNull]
    private int $prizeMoney;

    #[ORM\Column(type: 'string')]
    #[Assert\NotNull]
    private string $img_path;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Tournament
    {
        $this->id = $id;
        return $this;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): Tournament
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): Tournament
    {
        $this->endDate = $endDate;
        return $this;
    }
    

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Tournament
    {
        $this->name = $name;
        return $this;
    }

    public function getEntryPrice(): ?int
    {
        return $this->entryPrice;
    }

    public function setEntryPrice(int $entryPrice): Tournament
    {
        $this->entryPrice = $entryPrice;
        return $this;
    }

    public function getRules(): string
    {
        return $this->rules;
    }

    public function setRules(string $rules): Tournament
    {
        $this->rules = $rules;
        return $this;
    }

    public function getNbSlots(): ?int
    {
        return $this->nbSlots;
    }

    public function setNbSlots(?int $nbSlots): Tournament
    {
        $this->nbSlots = $nbSlots;
        return $this;
    }

    public function getNbSlotsTaken(): ?int
    {
        return $this->nbSlotsTaken;
    }

    public function setNbSlotsTaken(?int $nbSlotsTaken): Tournament
    {
        $this->nbSlotsTaken = $nbSlotsTaken;
        return $this;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail): Tournament
    {
        $this->mail = $mail;
        return $this;
    }

    public function getAdress(): string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): Tournament
    {
        $this->adress = $adress;
        return $this;
    }

    public function getPrizeMoney(): ?int
    {
        return $this->prizeMoney;
    }

    public function setPrizeMoney(int $prizeMoney): Tournament
    {
        $this->prizeMoney = $prizeMoney;
        return $this;
    }

    public function getImgPath() : string
    {
        return $this->img_path;
    }

    public function setImgPath(string $img_path): Tournament
    {
        $this->img_path = $img_path;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('%s %s', $this->name, $this->rules);
    }

    


}