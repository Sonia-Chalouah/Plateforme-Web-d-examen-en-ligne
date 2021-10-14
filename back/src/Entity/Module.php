<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ModuleRepository::class)
 */
class Module implements AuthoredEntityInterface,PublishedDateEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="modules")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity=QuizModuleComposition::class, mappedBy="module")
     */
    private $quizModuleCompositions;

    public function __construct()
    {
        $this->quizModuleCompositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?UserInterface $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection|QuizModuleComposition[]
     */
    public function getQuizModuleCompositions(): Collection
    {
        return $this->quizModuleCompositions;
    }

    public function addQuizModuleComposition(QuizModuleComposition $quizModuleComposition): self
    {
        if (!$this->quizModuleCompositions->contains($quizModuleComposition)) {
            $this->quizModuleCompositions[] = $quizModuleComposition;
            $quizModuleComposition->setModule($this);
        }

        return $this;
    }

    public function removeQuizModuleComposition(QuizModuleComposition $quizModuleComposition): self
    {
        if ($this->quizModuleCompositions->removeElement($quizModuleComposition)) {
            // set the owning side to null (unless already changed)
            if ($quizModuleComposition->getModule() === $this) {
                $quizModuleComposition->setModule(null);
            }
        }

        return $this;
    }

    public function __toString():string
    {
        return (string) $this->id.'- '.$this->name;
    }
}
