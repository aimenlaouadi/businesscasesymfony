<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Service;
use App\Entity\ServiceProduct; // Assurez-vous que cette entité existe pour gérer la relation entre Product et Service
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Fixtures pour les services
        $servicesData = [
            ['type' => 'Nettoyage pro', 'description' => 'Nous détachons et nettoyons tous vos vêtements...','price' => 10.00, 'images' => 'https://www.delcourt.fr/img/cms/Blog/nettoyer-d%C3%A9tacher-v%C3%AAtements-travail-delcourt-fr.jpg'],
            ['type' => 'Blanchisserie', 'description' => 'Retrouvez vos couettes, draps et linge de maison...','price' => 15.00, 'images' => 'https://lh4.googleusercontent.com/proxy/CPEuNL6WktEIGSYuze15KnG_efVtdUdLYdySOwGYxv44jNz8VA-sFE-R9X49F5jcy6ktSXOAisoN2nqyFnbBRohJ0wRUAzAIRh9q2xOf1dUpS-4'],
            ['type' => 'Rénovation cuir', 'description' => 'Détachage, nettoyage, re-coloration...','price' => 13.00, 'images' => 'https://colblanc.com/wp-content/uploads/2019/02/Comment-nettoyer-son-blouson-en-cuir.jpg'],
            ['type' => 'Repassage', 'description' => 'Nous vous proposons un service de repassage...','price' => 13.00, 'images' => 'https://colblanc.com/wp-content/uploads/2019/02/Comment-nettoyer-son-blouson-en-cuir.jpg'],
        ];

        $services = [];

        foreach ($servicesData as $data) {
            $service = new Service();
            $service->setServiceType($data['type']);
            $service->setDescription($data['description']);
            $service->setServicePrice($data['price']);
            $service->setImages($data['images']);
            $manager->persist($service);
            $services[] = $service; // Stocker les services pour les utiliser plus tard
        }


        $manager->flush(); // Sauvegarder les catégories et services dans la base de données

        // Fixtures pour les produits
        $productsData = [
            ['name' => 'Jeans', 'descriptif' => 'Ceci est un jeans!','services' => ['Nettoyage pro', 'Repassage']],
            ['name' => 'Chemise', 'descriptif' => 'Ceci est une chemise!', 'services' => ['Repassage']],
            ['name' => 'Pantalon', 'descriptif' => 'Ceci est un pantalon!','services' => ['Nettoyage pro']],
            ['name' => 'Basket', 'descriptif' => 'Ceci est des baskets!', 'services' => ['Blanchisserie']],
            ['name' => 'Couette', 'descriptif' => 'Ceci est une couette!', 'services' => ['Blanchisserie']],
        ];

        foreach ($productsData as $data) {
            $product = new Product();
            $product->setProductName($data['name']);
            $product->setProductDescription($data['descriptif']);

            // Associer la catégorie au produit


            $manager->persist($product);

            // Associer les services au produit via ServiceProduct
            foreach ($data['services'] as $serviceName) {
                foreach ($services as $service) {
                    if ($service->getServiceType() === $serviceName) {
                        $serviceProduct = new ServiceProduct();
                        $serviceProduct->setProduct($product);
                        $serviceProduct->setService($service);
                        $manager->persist($serviceProduct);
                    }
                }
            }
        }

        // Fixtures pour les utilisateurs
        $user1 = new User();
        $user1->setUsername('Utilisateur');
        $user1->setPassword('test1'); // Pensez à encoder le mot de passe en utilisant un PasswordHasher dans un vrai projet
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('Admin');
        $user2->setPassword('test2'); // Pensez à encoder le mot de passe
        $user2->setRoles(['ROLE_ADMIN']);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('SuperAdmin');
        $user3->setPassword('test3'); // Pensez à encoder le mot de passe
        $user3->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($user3);

        $manager->flush(); // Sauvegarder tous les produits et utilisateurs dans la base de données
    }
}
