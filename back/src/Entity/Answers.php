<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnswersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AnswersRepository::class)
 */
class Answers implements AuthoredEntityInterface,PublishedDateEntityInterface
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
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $helper;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="answers")
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=QuestionAnswer::class, inversedBy="anwser")
     */
    private $questionAnswer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isGoodAnswer;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="answers")
     */
    private $question;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getHelper(): ?string
    {
        return $this->helper;
    }

    public function setHelper(string $helper): self
    {
        $this->helper = $helper;

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

    public function getQuestionAnswer(): ?QuestionAnswer
    {
        return $this->questionAnswer;
    }

    public function setQuestionAnswer(?QuestionAnswer $questionAnswer): self
    {
        $this->questionAnswer = $questionAnswer;

        return $this;
    }

    public function getIsGoodAnswer(): ?bool
    {
        return $this->isGoodAnswer;
    }

    public function setIsGoodAnswer(bool $isGoodAnswer): self
    {
        $this->isGoodAnswer = $isGoodAnswer;

        return $this;
    }

    public function __toString():string
    {
        return (string) $this->id.'- '.$this->label;
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
}
