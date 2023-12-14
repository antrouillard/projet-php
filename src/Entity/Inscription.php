<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Repository\InscriptionRepository;
use Symfony\Component\Validator\Constraints as Assert;

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
    private string $date_inscription;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'The email must be at least {{ limit }} characters long',
        maxMessage: 'The email cannot be longer than {{ limit }} characters',
    )]
    private string $email;

    public function getIdInscription(): ?int
    {
        return $this->id_inscription;
    }

    public function setIdInscription(?int $id_inscription): Inscription
    {
        $this->id_inscription = $id_inscription;
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

}