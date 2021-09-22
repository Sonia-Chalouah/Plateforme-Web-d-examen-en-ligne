<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\ResetPasswordAction;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(
 * itemOperations={
 *         "get"={
 *             "access_control"="is_granted('IS_AUTHENTICATED_FULLY')",
 *             "normalization_context"={
 *                 "groups"={"get"}
 *             }
 *         },
 *         "put"={
 *             "access_control"="is_granted('IS_AUTHENTICATED_FULLY') and object == user",
 *             "denormalization_context"={
 *                 "groups"={"put"}
 *             },
 *             "normalization_context"={
 *                 "groups"={"get"}
 *             }
 *         },
 *         "put-reset-password"={
 *             "security"="is_granted('IS_AUTHENTICATED_FULLY') and object == user",
 *             "method"="PUT",
 *             "path"="/users/{id}/reset-password",
 *             "controller"=ResetPasswordAction::class,
 *             "denormalization_context"={
 *                 "groups"={"put-reset-password"}
 *             },
 *             "validation_groups"={"put-reset-password"}
 *         }
 *     },
 *     collectionOperations={
 *         "post"={
 *             "denormalization_context"={
 *                 "groups"={"post"}
 *             },
 *             "normalization_context"={
 *                 "groups"={"get"}
 *             },
 *             "validation_groups"={"post"}
 *         }
 *     },
 * )
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 * @method string getUserIdentifier()
 */
 class User implements UserInterface
{

    const ROLE_USER= 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';

    const DEFAULT_ROLES = [self::ROLE_USER];


     /**
      * @ORM\Id()
      * @ORM\GeneratedValue()
      * @ORM\Column(type="integer")
      * @Groups({"get", "get-quiz-session-with-author", "get-question-with-author"})
      */
     private $id;

     /**
      * @ORM\Column(type="string", length=255)
      * @Groups({"get", "post", "get-quiz-session-with-author" ,"get-question-with-author"})
      * @Assert\NotBlank(groups={"post"})
      * @Assert\Length(min=6, max=255, groups={"post"})
      */
     private $username;

     /**
      * @ORM\Column(type="string", length=255)
      * @Groups({"post"})
      * @Assert\NotBlank(groups={"post"})
      * @Assert\Regex(
      *     pattern="/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{7,}/",
      *     message="Password must be seven characters long and contain at least one digit, one upper case letter and one lower case letter",
      *     groups={"post"}
      * )
      */
     private $password;

     /**
      * @Groups({"post"})
      * @Assert\NotBlank(groups={"post"})
      * @Assert\Expression(
      *     "this.getPassword() === this.getRetypedPassword()",
      *     message="Passwords does not match",
      *     groups={"post"}
      * )
      */
     private $retypedPassword;

     /**
      * @Groups({"put-reset-password"})
      * @Assert\NotBlank(groups={"put-reset-password"})
      * @Assert\Regex(
      *     pattern="/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{7,}/",
      *     message="Password must be seven characters long and contain at least one digit, one upper case letter and one lower case letter",
      *     groups={"put-reset-password"}
      * )
      */
     private $newPassword;

     /**
      * @Groups({"put-reset-password"})
      * @Assert\NotBlank(groups={"put-reset-password"})
      * @Assert\Expression(
      *     "this.getNewPassword() === this.getNewRetypedPassword()",
      *     message="Passwords does not match",
      *     groups={"put-reset-password"}
      * )
      */
     private $newRetypedPassword;

     /**
      * @Groups({"put-reset-password"})
      * @Assert\NotBlank(groups={"put-reset-password"})
      * @UserPassword(groups={"put-reset-password"})
      */
     private $oldPassword;

     /**
      * @ORM\Column(type="string", length=255)
      * @Groups({"get", "post", "put", "get-quiz-session-with-author", "get-question-with-author"})
      * @Assert\NotBlank(groups={"post"})
      * @Assert\Length(min=5, max=255, groups={"post", "put"})
      */
     private $name;

     /**
      * @ORM\Column(type="string", length=255)
      * @Groups({"post", "put"})
      * @Assert\NotBlank(groups={"post"})
      * @Assert\Email(groups={"post", "put"})
      * @Assert\Length(min=6, max=255, groups={"post", "put"})
      */
     private $email;


     /**
      * @ORM\Column(type="simple_array", length=200)
      * @Groups({"post", "put"})
      */
     private $roles;

     /**
      * @ORM\Column(type="integer", nullable=true)
      */
     private $passwordChangeDate;

     /**
      * @ORM\Column(type="boolean")
      */
     private $enabled;

     /**
      * @ORM\Column(type="text", length=40, nullable=true)
      */
     private $confirmationToken;

     /**
      * @ORM\OneToMany(targetEntity="App\Entity\QuizSession", mappedBy="author")
      * @Groups({"get"})
      */
     private $quizSessions;

     /**
      * @ORM\OneToMany(targetEntity="App\Entity\QuizSessionQuestion", mappedBy="author")
      * @Groups({"get"})
      */
     private $questions;


    public function __construct()
    {
        $this->roles = self::DEFAULT_ROLES;
        $this->enabled = false;
        $this->confirmationToken = null;
        $this->quizSessions = new ArrayCollection();
        $this->questions = new ArrayCollection();

    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }

    public function getRetypedPassword()
    {
        return $this->retypedPassword;
    }

    public function setRetypedPassword($retypedPassword): void
    {
        $this->retypedPassword = $retypedPassword;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword($newPassword): void
    {
        $this->newPassword = $newPassword;
    }

    public function getNewRetypedPassword(): ?string
    {
        return $this->newRetypedPassword;
    }

    public function setNewRetypedPassword($newRetypedPassword): void
    {
        $this->newRetypedPassword = $newRetypedPassword;
    }

    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function setOldPassword($oldPassword): void
    {
        $this->oldPassword = $oldPassword;
    }

    public function getPasswordChangeDate()
    {
        return $this->passwordChangeDate;
    }

    public function setPasswordChangeDate($passwordChangeDate): void
    {
        $this->passwordChangeDate = $passwordChangeDate;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled($enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken($confirmationToken): void
    {
        $this->confirmationToken = $confirmationToken;
    }

     /**
      * @return ArrayCollection
      */
     public function getQuestions(): ArrayCollection
     {
         return $this->questions;
     }

     /**
      * @param ArrayCollection $questions
      */
     public function setQuestions(ArrayCollection $questions): void
     {
         $this->questions = $questions;
     }

     /**
      * @return Collection
      */
     public function getQuizSession(): Collection
     {
         return $this->quizSessions;
     }

    public function __toString(): string
    {
        return $this->name;
    }

     public function __call($name, $arguments)
     {
         // TODO: Implement @method string getUserIdentifier()
     }
     public function  __clone()
     {
        return $this;
     }
 }
