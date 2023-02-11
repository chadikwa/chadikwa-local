<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\HelloWorldRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HelloWorldRepository::class)]
#[ApiResource]
class HelloWorld
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
