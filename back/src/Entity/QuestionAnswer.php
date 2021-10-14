<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\QuestionAnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=QuestionAnswerRepository::class)
 */
class QuestionAnswer implements AuthoredEntityInterface,PublishedDateEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="questionAnswers")
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="questionAnswers",)
     */
    private $question;

    /**
     * @ORM\OneToMany(targetEntity=Answers::class, mappedBy="questionAnswer",cascade={"persist"})
     */
    private $anwser;

    public function __construct()
    {
        $this->anwser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection|Answers[]
     */
    public function getAnwser(): Collection
    {
        return $this->anwser;
    }

    public function addAnwser(Answers $anwser): self
    {
        if (!$this->anwser->contains($anwser)) {
            $this->anwser[] = $anwser;
            $anwser->setQuestionAnswer($this);
        }

        return $this;
    }

    public function removeAnwser(Answers $anwser): self
    {
        if ($this->anwser->removeElement($anwser)) {
            // set the owning side to null (unless already changed)
            if ($anwser->getQuestionAnswer() === $this) {
                $anwser->setQuestionAnswer(null);
            }
        }

        return $this;
    }
    public function __toString():string
    {
        return (string) $this->id;
    }
}
