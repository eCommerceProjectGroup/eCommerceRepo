<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\UserContactType;

class UserController extends AbstractController
{
    public function welcome(Request $req): Response
    {
        $order = $req->get('order');

        return $this->render('shop/account/welcome.html.twig', [
            'order' => $order,
        ]);
    }

}
