<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $body = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createdBy = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Group $postGroup = null;

    #[ORM\OneToMany(targetEntity: PostAttachment::class, mappedBy: 'post')]
    private Collection $attatchments;

    #[ORM\OneToMany(targetEntity: PostReaction::class, mappedBy: 'post', orphanRemoval: true)]
    private Collection $reactions;

    public function __construct()
    {
        $this->attatchments = new ArrayCollection();
        $this->reactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getPostGroup(): ?Group
    {
        return $this->postGroup;
    }

    public function setPostGroup(?Group $postGroup): static
    {
        $this->postGroup = $postGroup;

        return $this;
    }

    /**
     * @return Collection<int, PostAttachment>
     */
    public function getAttatchments(): Collection
    {
        return $this->attatchments;
    }

    public function addAttatchment(PostAttachment $attatchment): static
    {
        if (!$this->attatchments->contains($attatchment)) {
            $this->attatchments->add($attatchment);
            $attatchment->setPost($this);
        }

        return $this;
    }

    public function removeAttatchment(PostAttachment $attatchment): static
    {
        if ($this->attatchments->removeElement($attatchment)) {
            // set the owning side to null (unless already changed)
            if ($attatchment->getPost() === $this) {
                $attatchment->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostReaction>
     */
    public function getReactions(): Collection
    {
        return $this->reactions;
    }

    public function addReaction(PostReaction $reaction): static
    {
        if (!$this->reactions->contains($reaction)) {
            $this->reactions->add($reaction);
            $reaction->setPost($this);
        }

        return $this;
    }

    public function removeReaction(PostReaction $reaction): static
    {
        if ($this->reactions->removeElement($reaction)) {
            // set the owning side to null (unless already changed)
            if ($reaction->getPost() === $this) {
                $reaction->setPost(null);
            }
        }

        return $this;
    }
}
