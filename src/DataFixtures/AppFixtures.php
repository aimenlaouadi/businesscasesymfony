<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Service;
use App\Entity\StatusItems;
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
            ['type' => 'Nettoyage pro', 'description' => 'Nous détachons et nettoyons tous vos vêtements...','images' => 'nettoyage.jpg'],
            ['type' => 'Blanchisserie', 'description' => 'Retrouvez vos couettes, draps et linge de maison...','images' => 'blanchisserie.jpg'],
            ['type' => 'Rénovation cuir', 'description' => 'Détachage, nettoyage, re-coloration...','images' => 'renov-cuir.webp'],
            ['type' => 'Repassage', 'description' => 'Nous vous proposons un service de repassage...','images' => 'repassage.jpg'],
        ];

        $services = []; // Stocker les services pour les utiliser avec les produits

        foreach ($servicesData as $data) {
            $service = new Service();
            $service->setServiceType($data['type']);
            $service->setDescription($data['description']);
            $service->setImages($data['images']);
            $manager->persist($service);
            $services[] = $service; // Stocker le service dans le tableau
        }

        $manager->flush(); // Sauvegarder les services dans la base de données

        // Fixtures pour les produits
        $productsData = [
            ['name' => 'Jeans', 'descriptif' => 'Ceci est un jeans!', 'price' => 10.00,'images' =>'jeans.webp', 'services' => ['Nettoyage pro', 'Repassage']],
            ['name' => 'Chemise', 'descriptif' => 'Ceci est une chemise!', 'price' => 11.00,'images' =>'chemise.webp', 'services' => ['Repassage']],
            ['name' => 'Pantalon', 'descriptif' => 'Ceci est un pantalon!', 'price' => 12.00,'images' =>'pantalon.webp', 'services' => ['Nettoyage pro']],
            ['name' => 'Basket', 'descriptif' => 'Ceci est des baskets!', 'price' => 12.00,'images' =>'basket.webp', 'services' => ['Blanchisserie']],
            ['name' => 'Couette', 'descriptif' => 'Ceci est une couette!', 'price' => 13.00,'images' =>'couette.webp', 'services' => ['Blanchisserie']],
        ];

        foreach ($productsData as $data) {
            $product = new Product();
            $product->setProductName($data['name']);
            $product->setPrice($data['price']);
            $product->setProductDescription($data['descriptif']);
            $product->setImages($data['images']);
            $product->setQuantity(0);

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
        $user2->setPassword('test2'); 
        $user2->setRoles(['ROLE_ADMIN']);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('SuperAdmin');
        $user3->setPassword('test3');
        $user3->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($user3);


        $user4 = new User();
        $user4->setUsername('aimen');
        $user4->setPassword('aimen');
        $user4->setRoles(['ROLE_USER']);
        $manager->persist($user4);


        $status = new StatusItems();
        $status->setType('En Cours');
        $manager->persist($status);


        $manager->flush(); 



}
}