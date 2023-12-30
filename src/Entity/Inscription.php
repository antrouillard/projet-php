<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Repository\InscriptionRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
#[ORM\Table(name: 'inscription')]
class Inscription
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id_inscription = null;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private ?DateTime $date_inscription;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: 'The email must be at least {{ limit }} characters long',
        maxMessage: 'The email cannot be longer than {{ limit }} characters',
    )]
    private string $email;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id')]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Tournament::class)]
    #[ORM\JoinColumn(name: 'tournament_id', referencedColumnName: 'id')]
    private Tournament $tournament;

    public function getIdInscription(): ?int
    {
        return $this->id_inscription;
    }

    public function setIdInscription(?int $id_inscription): Inscription
    {
        $this->id_inscription = $id_inscription;
        return $this;
    }

    public function getDateInscription(): ?\DateTime
    {
        return $this->date_inscription;
    }

    public function setDateInscription(?\DateTime $date_inscription): Inscription
    {
        $this->date_inscription = $date_inscription;
        return $this;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function setEmail(string $email): Inscription
    {
        $this->email = $email;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): Inscription
    {
        $this->user = $user;
        return $this;
    }

    public function getTournament(): Tournament
    {
        return $this->tournament;
    }

    public function setTournament(Tournament $tournament): Inscription
    {
        $this->tournament = $tournament;
        return $this;
    }
}