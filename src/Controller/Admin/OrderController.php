<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Order;
use App\Form\OrderStatusType;

class OrderController extends AbstractController
{
    public function index()
    {
        $orders = $this->getDoctrine()
            ->getRepository(Order::class)
            ->findAll();
        
        return $this->render('admin/orders.html.twig', [
            'orders' => $orders,
        ]);
    }

    
}
