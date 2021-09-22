<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\QuizSessionQuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     attributes={
 *         "order"={"published": "DESC"},
 *         "pagination_client_enabled"=true,
 *         "pagination_client_items_per_page"=true
 *     },
 *     itemOperations={
 *         "get",
 *          "put"={
 *             "access_control"="is_granted('ROLE_EDITOR') and object.getAuthor() == user)"
 *         }
 *     },
 *     collectionOperations={
 *         "get",
 *         "post"={
 *             "normalization_context"={
 *                 "groups"={"get-question-with-author"}
 *             }
 *         },
 *         "api_quiz_sessions_questions_get_subresource"={
 *             "normalization_context"={
 *                 "groups"={"get-question-with-author"}
 *             }
 *         }
 *     },
 *     denormalizationContext={
 *         "groups"={"post"}
 *     }
 * )
 * @ORM\Entity(repositoryClass=QuizSessionQuestionRepository::class)
 */
class QuizSessionQuestion implements AuthoredEntityInterface, PublishedDateEntityInterface
{


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-question-with-author"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"post", "get-question-with-author"})
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=3000)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"get-question-with-author"})
     */
    private ?\DateTimeInterface $published;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get-question-with-author"})
     */
    private ?User $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuizSession", inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"post"})
     */
    private ?QuizSession $quizSession;



    public function getId()
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

    public function getPublished(): ?\DateTimeInterface
    {
        return $this->published;
    }

    public function setPublished(\DateTimeInterface $published): PublishedDateEntityInterface
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param UserInterface $user
     * @return AuthoredEntityInterface
     */
    public function setAuthor(UserInterface $user): AuthoredEntityInterface
    {
        $this->author = $user;

        return $this;
    }

    public function getQuizSession(): ?QuizSession
    {
        return $this->quizSession;
    }

    public function setQuizSession(QuizSession $quizSession): self
    {
        $this->quizSession = $quizSession;

        return $this;
    }

    public function __toString()
    {
        return substr($this->content, 0, 20) . '...';
    }

}
