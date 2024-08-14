<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Service;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Fixtures pour les services
        $servicesData = [
            ['type' => 'Nettoyage pro','description' => 'Nous détachons et nettoyons tous vos vêtements (pantalon, chemise, veste, robe, costume…) même les plus délicats.', 'coef' => 0.5, 'price' => 10.00, 'images' =>'https://www.delcourt.fr/img/cms/Blog/nettoyer-d%C3%A9tacher-v%C3%AAtements-travail-delcourt-fr.jpg'],
            ['type' => 'Blanchisserie','description' => 'Retrouvez vos couettes, draps et linge de maison plus blanc qu’avant grâce au traitement blanchissant.', 'coef' => 0.7, 'price' => 15.00, 'images' =>'https://lh4.googleusercontent.com/proxy/CPEuNL6WktEIGSYuze15KnG_efVtdUdLYdySOwGYxv44jNz8VA-sFE-R9X49F5jcy6ktSXOAisoN2nqyFnbBRohJ0wRUAzAIRh9q2xOf1dUpS-4'],
            ['type' => 'Rénovation cuir','description' => 'Détachage, nettoyage, re-coloration, traitement nourrissant… nous mettons tout en œuvre pour vous restituer vos vêtements de cuir comme neuf !', 'coef' => 0.8, 'price' => 13.00, 'images' =>'https://colblanc.com/wp-content/uploads/2019/02/Comment-nettoyer-son-blouson-en-cuir.jpg'],
            ['type' => 'Repassage','description' => 'Nous vous propose un service de repassage de chemises et repassage au kilos. Ne perdez plus de temps et confiez-nous votre repassage !', 'coef' => 0.5, 'price' => 13.00, 'images' =>'https://colblanc.com/wp-content/uploads/2019/02/Comment-nettoyer-son-blouson-en-cuir.jpg'],
        ];

        foreach ($servicesData as $data) {
            $service = new Service();
            $service->setServiceType($data['type']);
            $service->setDescription($data['description']);
            $service->setServiceCoef($data['coef']);
            $service->setServicePrice($data['price']);
            $service->setImages($data['images']);
            $manager->persist($service);
        }

        
        $categoryData = [
            ['name' => 'haut', 'image' => 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcRNdOUHo8V-M40NHxE5jQP6B9cTYxVR0c9noEYGCFwRQEYXA8MsoTeXuosuEL7RKp9DCQGBLqoDfVeyngBPHGYvhQGrrVcySuKirILmXIMLYX5xsHl-WIUWzkY8FZqQlNrX6SNc6Cg&usqp=CAc'],
            ['name' => 'bas', 'image' => 'https://example.com/path/to/your/image2.jpg'],
            ['name' => 'vêtement sport', 'image' => 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcR7arOhrgBOn7M9NvQBRgi3Zrq-YQrhIJsIn4aHpyfu8ZSvZHUx_csxoWcwTLBi9s6hO0fAQW_3bAfPSht3RECwmUubCSGXYEKifK7YSHeFtbrTcElBGF0qpgHF8Tl8HuI0gntLGkNl8w&usqp=CAc'],
            ['name' => 'veste', 'image' => 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcQPtNSpC-0z7kjduXPXxDIpcjtY9Kt53Ax7fYa6fsxMM23WQVcMPRCXC3u4qOtVSgaAUt8VxJ8-i2JebN8Nlta9XyEnL-c3BjENpG3X4wf7UUZyCpZuL6yQ81gOHqF1Qlq9x9266JcsNg&usqp=CAc'],
        ];

        $categories = [];

        foreach ($categoryData as $data) {
            $category = new Category();
            $category->setCategoryName($data['name']);
            $category->setImages($data['image']);
            $manager->persist($category);
            $categories[] = $category; 
        }

        $manager->flush(); 

        $productsData = [
            ['name' => 'Jeans', 'descriptif' => 'Ceci est un jeans!', 'category' => 'bas'],
            ['name' => 'Chemise', 'descriptif' => 'Ceci est une chemise!', 'category' => 'haut'],
            ['name' => 'Pantalon', 'descriptif' => 'Ceci est un pantalon!', 'category' => 'bas'],
            ['name' => 'Basket', 'descriptif' => 'Ceci est des baskets!', 'category' => 'vêtement sport'],
        ];

        foreach ($productsData as $data) {
            $product = new Product();
            $product->setProductName($data['name']);
            $product->setProductDescription($data['descriptif']);

            foreach ($categories as $category) {
                if ($category->getCategoryName() === $data['category']) {
                    $product->setCategory($category);
                    break;
                }
            }

            $manager->persist($product);
        }
        

        
        $user1 = new User();
        $user1->setUsername('Utilisateur');
        $user1->setPassword('test1');
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

        $manager->flush();
    }
}
