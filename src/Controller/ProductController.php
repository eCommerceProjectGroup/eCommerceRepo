<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;
use App\Repository\ProductRepository;

class ProductController extends AbstractController
{
    public function index(ProductRepository $productRepository)
    {
        $allProducts = $productRepository->findAll();

        return $this->render('shop/index.html.twig', [
            'all_products' => $allProducts
        ]);
    }

}
