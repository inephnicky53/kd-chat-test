<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MetadataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetadataRepository::class)]
#[ApiResource]
class Metadata
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $readAt = null;

    #[ORM\ManyToOne(inversedBy: 'metadata',cascade:["persist"])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'metadata',cascade:["persist"])]
    private ?Message $message = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReadAt(): ?\DateTimeImmutable
    {
        return $this->readAt;
    }

    public function setReadAt(\DateTimeImmutable $readAt): self
    {
        $this->readAt = $readAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $person): self
    {
        $this->user = $person;

        return $this;
    }

    public function getMessage(): ?Message
    {
        return $this->message;
    }

    public function setMessage(?Message $message): self
    {
        $this->message = $message;

        return $this;
    }
}
