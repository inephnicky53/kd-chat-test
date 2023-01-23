<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Repository\MessageRepository;
use App\Resolver\MessageMutationResolver;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[ApiResource(
    mercure: true,
    graphQlOperations: [
        new Query(security: "is_granted('MESSAGE_READ',object)"),
        new QueryCollection(security: "is_granted('ROLE_USER')"),
        new Mutation(name: 'create'),
        new Mutation(name: 'update')
    ]
)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?Thread $thread = null;

    #[ORM\OneToMany(mappedBy: 'message', targetEntity: Metadata::class, cascade: ["persist"])]
    private Collection $metadata;

    #[ORM\ManyToOne(inversedBy: 'messages', cascade: ["persist"])]
    private ?User $sender = null;

    public function __construct()
    {
        $this->metadata = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getThread(): ?Thread
    {
        return $this->thread;
    }

    public function setThread(?Thread $thread): self
    {
        $this->thread = $thread;

        return $this;
    }

    /**
     * @return Collection<int, Metadata>
     */
    public function getMetadata(): Collection
    {
        return $this->metadata;
    }

    public function addMetadata(Metadata $metadata): self
    {
        if (!$this->metadata->contains($metadata)) {
            $this->metadata->add($metadata);
            $metadata->setMessage($this);
        }

        return $this;
    }

    public function removeMetadata(Metadata $metadata): self
    {
        if ($this->metadata->removeElement($metadata)) {
            // set the owning side to null (unless already changed)
            if ($metadata->getMessage() === $this) {
                $metadata->setMessage(null);
            }
        }

        return $this;
    }

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
