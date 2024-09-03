<?php

namespace App\Controller\Admin;

use App\Entity\StatusItems;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions; 
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;    
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class StatusItemsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StatusItems::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $viewAction = Action::new('view', 'View')
            ->linkToCrudAction('detail');

        return $actions
            ->add(Crud::PAGE_INDEX, $viewAction)
            ->add(Crud::PAGE_DETAIL, $viewAction);
    }
}
