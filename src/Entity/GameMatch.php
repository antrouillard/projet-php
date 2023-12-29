<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Repository\GameMatchRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Entity\User;
use Entity\Team;


#[ORM\Entity(repositoryClass: GameMatchRepository::class)]
#[ORM\Table(name: 'matchs')]

class GameMatch
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\ManyToOne(targetEntity: Participant::class)]
    #[ORM\JoinColumn(name: "participant1_id", referencedColumnName: "id")]
    private ?Participant $participant1;

    #[ORM\ManyToOne(targetEntity: Participant::class)]
    #[ORM\JoinColumn(name: "participant2_id", referencedColumnName: "id")]
    private ?Participant $participant2;

    #[ORM\Column(type: 'date')]
    #[Assert\NotNull]
    private ?DateTime $matchDate;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'The game name must be at least {{ limit }} characters long',
        maxMessage: 'The game name cannot be longer than {{ limit }} characters',
    )]
    private string $jeu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): GameMatch
    {
        $this->id = $id;
        return $this;
    }

    public function getParticipant1(): Participant
    {
        return $this->participant1;
    }

    public function setParticipant1(Participant $participant1): GameMatch
    {
        $this->participant1 = $participant1;
        return $this;
    }


    public function getParticipant2(): Participant
    {
        return $this->participant2;
    }

    public function setParticipant2(Participant $participant2): GameMatch
    {
        $this->participant2 = $participant2;
        return $this;
    }

    public function getMatchDate(): ?\DateTime
    {
        return $this->matchDate;
    }

    public function setMatchDate(?\DateTime $matchDate): GameMatch
    {
        $this->matchDate = $matchDate;
        return $this;
    }

    public function getJeu() : string
    {
        return $this->jeu;
    }

    public function setJeu(string $jeu): GameMatch
    {
        $this->jeu = $jeu;
        return $this;
    }

   /* public function __toString(): string
    {
        return sprintf('%s %s', $this->, $this->niveau);
    }*/

}