<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;
use App\Entity\Transaction;

class AdminController extends AbstractController
{
    public function index()
    {
        
        return $this->render('admin/index.html.twig');
    }
}
