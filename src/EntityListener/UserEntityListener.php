<?php

namespace App\EntityListener;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, entity: User::class)]
class UserEntityListener
{

    public function __construct(
        private SluggerInterface $slugger,
    ) {
    }

    public function prePersist(User $user, LifecycleEventArgs $event)
    {
        $user->setUsername($this->slugger->slug($user->getName()));
    }
}