<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

abstract class BaseCrudController extends AbstractCrudController
{
    public function configureActions(Actions $actions): Actions
    {
        $viewAction = Action::new('view', 'View')
            ->linkToCrudAction('detail')
            ->setIcon('fa fa-eye');

        return $actions
            ->add(Crud::PAGE_INDEX, $viewAction)
            ->add(Crud::PAGE_DETAIL, $viewAction);
    }
}
