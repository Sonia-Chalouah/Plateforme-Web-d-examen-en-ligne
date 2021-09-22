<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\QuizSessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;

/**
 * @ORM\Entity(repositoryClass=QuizSessionRepository::class)
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *         "title": "partial",
 *         "content": "partial",
 *         "author": "exact",
 *         "author.name": "partial"
 *     }
 * )
 * @ApiFilter(
 *     DateFilter::class,
 *     properties={
 *         "published"
 *     }
 * )
 * @ApiFilter(RangeFilter::class, properties={"id"})
 * @ApiFilter(
 *     OrderFilter::class,
 *     properties={
 *         "id",
 *         "published",
 *         "title"
 *     },
 *     arguments={"orderParameterName"="_order"}
 * )
 * @ApiFilter(PropertyFilter::class, arguments={
 *     "parameterName": "properties",
 *     "overrideDefaultProperties": false,
 *     "whitelist": {"id", "slug", "title", "content", "author"}
 * })
 * @ApiResource(
 *     attributes={"order"={"published": "DESC"}, "maximum_items_per_page"=30},
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"get-quiz-session-with-author"}
 *             }
 *          },
 *         "put"={
 *             "access_control"="is_granted('ROLE_EDITOR') or (is_granted('ROLE_WRITER') and object.getAuthor() == user)"
 *         }
 *     },
 *     collectionOperations={
 *         "get",
 *         "post"={
 *             "access_control"="is_granted('ROLE_WRITER')"
 *         }
 *     },
 *     denormalizationContext={
 *         "groups"={"post"}
 *     }
 * )
 */
class QuizSession implements AuthoredEntityInterface, PublishedDateEntityInterface
{

    const LEVEL_EASY = 'LEVEL_EASY';
    const LEVEL_MEDIUM = 'LEVEL_MEDIUM';
    const LEVEL_HARD = 'LEVEL_HARD';

    const DEFAULT_ROLES = [self::LEVEL_EASY];


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-quiz-session-with-author"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     * @Groups({"post", "get-quiz-session-with-author"})
     */
    private $title;


    /**
     * @ORM\Column(type="datetime")
     * @Groups({"get-quiz-session-with-author"})
     */
    private $published;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min=20)
     * @Groups({"post", "get-quiz-session-with-author"})
     */
    private $description;

    /**
     * @ORM\Column(type="simple_array", length=200)
     * @Assert\NotBlank()
     * @Groups({"post", "get-quiz-session-with-author"})
     */
    private array $level;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="quizSessions")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get-quiz-session-with-author"})
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QuizSessionQuestion", mappedBy="quizSession")
     * @ApiSubresource()
     * @Groups({"get-quiz-session-with-author"})
     */
    private $questions;


    public function __construct()
    {
        $this->level = self::DEFAULT_ROLES;
        $this->questions = new ArrayCollection();

    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPublished(): ?\DateTimeInterface
    {
        return $this->published;
    }

    public function setPublished(\DateTimeInterface $published): QuizSession
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level): void
    {
        $this->level = $level;
    }



    /**
     * @return User
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param UserInterface $author
     */
    public function setAuthor(UserInterface $author): QuizSession
    {
        $this->author = $author;

        return $this;
    }


    public function getQuestions()
    {
        return $this->questions;
    }


    public function setQuestions($questions): void
    {
        $this->questions = $questions;
    }



    public function __toString(): string
    {
        return $this->title;
    }
}
