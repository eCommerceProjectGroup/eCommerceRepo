<?php
namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Panier;
use App\Entity\Product;

class PanierController extends AbstractController
{
    private $panier;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->panier = new Panier($objectManager);
    }

    public function show()
    {
        $products = [];
        $totalPrice = 0;

        if ($this->panier->hasProducts()) {
            $products = $this->panier->getProducts();
            $totalPrice = $this->panier->totalPrice($products);
        }

        return $this->render('shop/panier.html.twig', [
            'products' => $products,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function add($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);
        
        if (!$product) {
            throw $this->createNotFoundException();
        }

       
       
        return $this->redirectToRoute('product_show');
    }

    public function remove($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);
        
        if (!$product) {
            throw $this->createNotFoundException();
        }

        $this->panier->remove($product);

        return $this->redirectToRoute('panier_show');
    }

    public function update(Request $req)
    {
        $data = json_decode($req->getContent(), true);
        $id = (int) $data['id'];
        $quantity = (int) $data['quantity'];
       
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);
        
        if (!$product) {
            throw $this->createNotFoundException();
        }

        $this->panier->update($product, $quantity);
            
        $products = $this->panier->getProducts();
        $totalPrice = $this->panier->totalPrice($products);

        return new JsonResponse([
            'price' => $product->calcTotalPrice(),
            'totalPrice' => $totalPrice,
        ]);
    }

    public function productCount()
    {
        return new Response(count($this->panier));
    }
}
