<?php

namespace App\Controller\Admin\Traits;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

trait EditTrait
{
    public function configureEditActions(Actions $actions): Actions
    {
        return $actions
            // L'admin peut éditer les entités
            ->setPermission(Action::EDIT, 'ROLE_ADMIN')    // Autoriser la modification pour les admins

            // L'admin peut voir la liste et les détails
            ->setPermission(Action::INDEX, 'ROLE_ADMIN')   // Afficher la liste des entités
            ->setPermission(Action::DETAIL, 'ROLE_ADMIN'); // Afficher les détails des entités
    }
}
