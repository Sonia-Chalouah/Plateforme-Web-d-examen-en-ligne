<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\QuizTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=QuizTypeRepository::class)
 */
class QuizType implements AuthoredEntityInterface,PublishedDateEntityInterface
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="quizTypes")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity=QuizModuleComposition::class, mappedBy="quizType")
     */
    private $quizModuleCompositions;

    /**
     * @ORM\OneToMany(targetEntity=Quiz::class, mappedBy="quizType")
     */
    private $quizzes;

    public function __construct()
    {
        $this->quizModuleCompositions = new ArrayCollection();
        $this->quizzes = new ArrayCollection();
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
            $quizModuleComposition->setQuizType($this);
        }

        return $this;
    }

    public function removeQuizModuleComposition(QuizModuleComposition $quizModuleComposition): self
    {
        if ($this->quizModuleCompositions->removeElement($quizModuleComposition)) {
            // set the owning side to null (unless already changed)
            if ($quizModuleComposition->getQuizType() === $this) {
                $quizModuleComposition->setQuizType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Quiz[]
     */
    public function getQuizzes(): Collection
    {
        return $this->quizzes;
    }

    public function addQuiz(Quiz $quiz): self
    {
        if (!$this->quizzes->contains($quiz)) {
            $this->quizzes[] = $quiz;
            $quiz->setQuizType($this);
        }

        return $this;
    }

    public function removeQuiz(Quiz $quiz): self
    {
        if ($this->quizzes->removeElement($quiz)) {
            // set the owning side to null (unless already changed)
            if ($quiz->getQuizType() === $this) {
                $quiz->setQuizType(null);
            }
        }

        return $this;
    }

    public function __toString():string
    {
        return (string) $this->id.'- '.$this->name;
    }
}
