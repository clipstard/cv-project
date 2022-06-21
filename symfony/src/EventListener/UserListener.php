<?php
namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher;

class UserListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        if ($args->getEntity() instanceof User) {
            $hasher = new NativePasswordHasher();
            /**
             * @var User $entity
             */
            $entity = $args->getEntity();
            $entity->setPassword($hasher->hash($entity->getPlainPassword()));
            $entity->eraseCredentials();
        }
    }
}