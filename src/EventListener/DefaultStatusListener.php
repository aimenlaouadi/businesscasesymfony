<?php

namespace App\EventListener;


use App\Entity\Items;
use App\Repository\StatusItemsRepository;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;

#[AsDoctrineListener(Events::prePersist)]
class DefaultStatusListener
{
    public function __construct(private StatusItemsRepository $statusItemsRepository) {}

    public function prePersist(PrePersistEventArgs $event): void
    {
        $entity = $event->getObject();

        if (!$entity instanceof Items) {
            return;
        }

        $defaultStatus = $this->statusItemsRepository->findOneByType('En attente de validation');
        $entity->setStatusItems($defaultStatus);
    }
}
