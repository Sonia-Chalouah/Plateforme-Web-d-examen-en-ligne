<?php


namespace App\EventSubscriber;

use App\Entity\AuthoredEntityInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AdminCreatedBySubscriber implements EventSubscriberInterface
{

    /**
     * @var TokenStorageInterface
     */
    private TokenStorageInterface $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedBy'],
        ];
    }

    public function setCreatedBy(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof AuthoredEntityInterface)) {
            return;
        }

        $token = $this->tokenStorage->getToken();
        $entity->setCreatedBy($token->getUser());
    }
}