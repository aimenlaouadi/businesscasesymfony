<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Service;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Fixtures pour les services
        $servicesData = [
            ['type' => 'Nettoyage pro', 'description' => 'Nous détachons et nettoyons tous vos vêtements...', 'price' => 10.00, 'images' => 'https://www.delcourt.fr/img/cms/Blog/nettoyer-d%C3%A9tacher-v%C3%AAtements-travail-delcourt-fr.jpg'],
            ['type' => 'Blanchisserie', 'description' => 'Retrouvez vos couettes, draps et linge de maison...', 'price' => 15.00, 'images' => 'https://lh4.googleusercontent.com/proxy/CPEuNL6WktEIGSYuze15KnG_efVtdUdLYdySOwGYxv44jNz8VA-sFE-R9X49F5jcy6ktSXOAisoN2nqyFnbBRohJ0wRUAzAIRh9q2xOf1dUpS-4'],
            ['type' => 'Rénovation cuir', 'description' => 'Détachage, nettoyage, re-coloration...', 'price' => 13.00, 'images' => 'https://colblanc.com/wp-content/uploads/2019/02/Comment-nettoyer-son-blouson-en-cuir.jpg'],
            ['type' => 'Repassage', 'description' => 'Nous vous proposons un service de repassage...', 'price' => 13.00, 'images' => 'https://colblanc.com/wp-content/uploads/2019/02/Comment-nettoyer-son-blouson-en-cuir.jpg'],
        ];

        $services = []; // Stocker les services pour les utiliser avec les produits

        foreach ($servicesData as $data) {
            $service = new Service();
            $service->setServiceType($data['type']);
            $service->setDescription($data['description']);
            $service->setServicePrice($data['price']);
            $service->setImages($data['images']);
            $manager->persist($service);
            $services[] = $service; // Stocker le service dans le tableau
        }

        $manager->flush(); // Sauvegarder les services dans la base de données

        // Fixtures pour les produits
        $productsData = [
            ['name' => 'Jeans', 'descriptif' => 'Ceci est un jeans!', 'price' => 10.00, 'services' => ['Nettoyage pro', 'Repassage']],
            ['name' => 'Chemise', 'descriptif' => 'Ceci est une chemise!', 'price' => 11.00, 'services' => ['Repassage']],
            ['name' => 'Pantalon', 'descriptif' => 'Ceci est un pantalon!', 'price' => 12.00, 'services' => ['Nettoyage pro']],
            ['name' => 'Basket', 'descriptif' => 'Ceci est des baskets!', 'price' => 12.00, 'services' => ['Blanchisserie']],
            ['name' => 'Couette', 'descriptif' => 'Ceci est une couette!', 'price' => 13.00, 'services' => ['Blanchisserie']],
        ];

        foreach ($productsData as $data) {
            $product = new Product();
            $product->setProductName($data['name']);
            $product->setPrice($data['price']);
            $product->setProductDescription($data['descriptif']);
            $product->setQuantity(0); // Initialiser la quantité à 0 par défaut

            // Associer les services au produit
            foreach ($data['services'] as $serviceName) {
                // Rechercher le service correspondant par nom
                foreach ($services as $service) {
                    if ($service->getServiceType() === $serviceName) {
                        $product->addService($service); // Associer le service au produit
                    }
                }
            }

            $manager->persist($product);
        }

        $manager->flush(); 

        // Fixtures pour les utilisateurs
        $user1 = new User();
        $user1->setUsername('Utilisateur');
        $user1->setPassword($this->passwordHasher->hashPassword($user1, 'test1')); 
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('Admin');
        $user2->setPassword($this->passwordHasher->hashPassword($user2, 'test2')); 
        $user2->setRoles(['ROLE_ADMIN']);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('SuperAdmin');
        $user3->setPassword($this->passwordHasher->hashPassword($user3, 'test3'));
        $user3->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($user3);

        $manager->flush(); 
}
}