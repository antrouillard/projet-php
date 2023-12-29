<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
class User extends Participant
{

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your username must be at least {{ limit }} characters long',
        maxMessage: 'Your username cannot be longer than {{ limit }} characters',
    )]
    private string $username;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Your password must be at least {{ limit }} characters long',
        maxMessage: 'Your password cannot be longer than {{ limit }} characters',
    )]
    private string $password;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('%s', $this->username);
    }


}
