<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
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