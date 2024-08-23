<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Items;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')] 
class OrderController extends AbstractController
{
    #[Route('/api/order/create', name: 'order_create', methods: ['POST'])]
    public function createOrder(Request $request, EntityManagerInterface $em): Response
    {
        $data = json_decode($request->getContent(), true);

        // Créer une nouvelle commande
        $order = new Order();
        $order->setDate(new \DateTime());
        $order->setUser($this->getUser());  // Assurez-vous que l'utilisateur est connecté

        // Ajouter les items à la commande
        foreach ($data['items'] as $itemData) {
            $item = new Items();
            $item->setPrice($itemData['price']);
            $item->setQuantite($itemData['quantite']);
            $em->persist($item);
            $order->addItem($item);
        }

        $em->persist($order);
        $em->flush();

        return new Response('Commande créée avec succès', Response::HTTP_CREATED);
    }
}
