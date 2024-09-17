<?php

namespace App\Controller\Admin\Traits;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

trait ViewTrait
{
    public function configureViewActions(Actions $actions): Actions
    {
        return $actions
  
            ->remove(Crud::PAGE_INDEX, Action::NEW)            
            ->remove(Crud::PAGE_INDEX, Action::EDIT)           
            ->remove(Crud::PAGE_INDEX, Action::DELETE);        
    }
}
