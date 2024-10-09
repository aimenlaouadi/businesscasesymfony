<?php
namespace App\Controller\Admin;

use App\Entity\Items;
use Doctrine\ORM\QueryBuilder; 
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Component\Security\Core\Security;

class ItemsCrudController extends AbstractCrudController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

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
        $fields = [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('service')->hideOnForm(),
            AssociationField::new('product')->hideOnForm(),
            AssociationField::new('statusItems'),
            NumberField::new('price')->hideOnForm(),
            NumberField::new('quantite')->hideOnForm(),
        ];

        // Si l'utilisateur est un administrateur, ajouter le champ 'employee'
        if ($this->security->isGranted('ROLE_ADMIN')) {
            $fields[] = AssociationField::new('employee');
        }

        return $fields;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        
        $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
    
        if ($this->security->isGranted('ROLE_EMPLOYEE')) {
            // Filtrer les éléments où l'employé connecté est affecté
            $user = $this->security->getUser();
            $qb->andWhere('entity.employee = :employee')
               ->setParameter('employee', $user);
        }
    
        return $qb;
    }
    
}
