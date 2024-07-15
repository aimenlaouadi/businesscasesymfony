<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Product;
use App\Entity\Service;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Fixtures pour les services
        $servicesData = [
            ['type' => 'Nettoyage pro','description' => 'Nous détachons et nettoyons tous vos vêtements (pantalon, chemise, veste, robe, costume…) même les plus délicats.', 'coef' => 0.5, 'price' => 10.00],
            ['type' => 'Blanchisserie','description' => 'Retrouvez vos couettes, draps et linge de maison plus blanc qu’avant grâce au traitement blanchissant.', 'coef' => 0.7, 'price' => 15.00],
            ['type' => 'Rénovation cuir','description' => 'Détachage, nettoyage, re-coloration, traitement nourrissant… nous mettons tout en œuvre pour vous restituer vos vêtements de cuir comme neuf !', 'coef' => 0.8, 'price' => 13.00], // Ajout d'un type manquant
        ];

        foreach ($servicesData as $data) {
            $service = new Service();
            $service->setServiceType($data['type']);
            $service->setDescription($data['description']);
            $service->setServiceCoef($data['coef']);
            $service->setServicePrice($data['price']);
            $manager->persist($service);
        }

        $manager->flush();

        // Fixtures pour les produits
        $productsData = [
            ['name' => 'Jeans', 'descriptif' => 'Ceci est un jeans!'],
            ['name' => 'Chemise', 'descriptif' => 'Ceci est une chemise!'],
            ['name' => 'Pantalon', 'descriptif' => 'Ceci est un pantalon!'],
            ['name' => 'Basket', 'descriptif' => 'Ceci est des baskets!'], // Capitalisation correcte
        ];

        foreach ($productsData as $data) {
            $product = new Product();
            $product->setProductName($data['name']);
            $product->setProductDescription($data['descriptif']);
            $manager->persist($product);
        }

        $manager->flush();

        // Fixtures pour les utilisateurs
        $user1 = new Users();
        $user1->setUsername('Utilisateur');
        $user1->setPassword('test1');
        $manager->persist($user1);

        $user2 = new Users();
        $user2->setUsername('Admin');
        $user2->setPassword('test2');
        $user2->setRoles(['Role_ADMIN']);
        $manager->persist($user2);

        $user3 = new Users();
        $user3->setUsername('SuperAdmin');
        $user3->setPassword('test3');
        $user3->setRoles(['Role_SUPER_ADMIN']); 
        $manager->persist($user3);

        $manager->flush();
    }
}
