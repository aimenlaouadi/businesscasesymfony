<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Traits\ViewTrait;
use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class OrderCrudController extends AbstractCrudController
{

    use ViewTrait;
    

    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $this->configureViewActions($actions);
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Order')
            ->setEntityLabelInPlural('Orders')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des Orders');
    }

}
