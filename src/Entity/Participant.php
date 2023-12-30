<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name : "type", type : "string")]
#[ORM\DiscriminatorMap([
    'user' => 'User',
    'team' => 'Team',
])]
#[ORM\Table(name: 'participants')]
abstract class Participant
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Participant
    {
        $this->id= $id;
        return $this;
    }
}