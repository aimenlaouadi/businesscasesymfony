<?php

namespace App\Controller\Admin\Traits;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

trait ViewAndDeleteTrait
{
    public function configureViewAndDeleteActions(Actions $actions): Actions
    {
        return $actions
            // L'admin peut voir la liste et les détails
            ->setPermission(Action::INDEX, 'ROLE_ADMIN')    
            ->setPermission(Action::DETAIL, 'ROLE_ADMIN')   

            // L'admin peut supprimer
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')    

            // On retire l'accès aux actions de modification et de création si nécessaire
            ->remove(Crud::PAGE_INDEX, Action::NEW)         
            ->remove(Crud::PAGE_INDEX, Action::EDIT);
    }
}
