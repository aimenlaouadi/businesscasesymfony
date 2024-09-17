<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Traits\EditTrait;
use App\Controller\Admin\Traits\ViewAndDeleteTrait;
use App\Entity\Items;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ItemsCrudController extends AbstractCrudController
{

    use ViewAndDeleteTrait;
    use EditTrait;
    
    public static function getEntityFqcn(): string
    {
        return Items::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Item')
            ->setEntityLabelInPlural('Items')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des Items');
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('employee',),
            AssociationField::new('service',)->hideOnForm(),
            AssociationField::new('product',)->hideOnForm(),
            AssociationField::new('statusItems',),
            NumberField::new('price')->hideOnForm(),
            NumberField::new('quantite')->hideOnForm(),

        ];
    }
}

