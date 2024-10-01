<?php
namespace App\Controller\Admin;

use App\Entity\Employee;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EmployeeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employee::class;
    }

 
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('statusItems'),
            TextField::new('employee')
                ->hideOnForm(),  // Masquer le champ 'employee' dans tous les cas
        ];
    }


}
