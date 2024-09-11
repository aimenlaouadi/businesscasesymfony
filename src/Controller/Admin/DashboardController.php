<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Employee;
use App\Entity\Items;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Service;
use App\Entity\StatusItems;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());


    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Businesscase');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Orders');
        yield MenuItem::linkToCrud('Orders', 'fa-brands fa-dropbox', Order::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('items', 'fa fa-tag', Items::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('StatusItems', 'fa-solid fa-signal', StatusItems::class)->setPermission('ROLE_ADMIN');

        yield MenuItem::section('Account')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Employee', 'fa-regular fa-adress-card', Employee::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('User', 'fa fa-tag', User::class)->setPermission('ROLE_ADMIN');


        yield MenuItem::section('Product & Services')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Product', 'fa fa-tag', Product::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Service', 'fa fa-tag', Service::class)->setPermission('ROLE_ADMIN');

        yield MenuItem::section('Contact');
        yield MenuItem::linkToCrud('Contact', 'fa fa-tag', Contact::class);

   
        yield MenuItem::section('Exit');
        yield MenuItem::linkToLogout('Deconnexion', 'fa fa-sign-out-alt');
     
    }
}
