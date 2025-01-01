<?php
namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    
     #[Route("/orders", name:"order_index")]
     
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('order/index.html.twig', [
            'orders' => $orderRepository->findAll(),
        ]);
    }

     #[Route("/orders/{id}", name:"order_details")]
    
    public function details(int $id, OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->find($id);

        return $this->render('order/details.html.twig', [
            'order' => $order,
        ]);
    }

     #[Route("/order/confirmation", name:"order_confirmation")]
    
    public function confirmation(): Response
    {
        return $this->render('order/confirmation.html.twig');
    }

    #[Route("/order/{id}/facture", name:"order_facture")]
    
    public function facture(int $id): Response
    {
        // Implémenter la logique pour générer ou afficher une facture.
        return $this->render('order/facture.html.twig');
    }
}
