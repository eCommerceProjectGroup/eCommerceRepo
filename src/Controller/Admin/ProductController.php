<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProductType;
use App\Entity\Product;

class ProductController extends AbstractController
{
    public function index(Request $req)
    {
        $form = $this->createFormBuilder()
            ->add('search', SearchType::class)
            ->getForm();
        
        $form->handleRequest($req);
                   
        if ($form->isSubmitted() && $form->isValid()) {
            $query = $form->getData();
            
            $products = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findAll();

        } else {
            $products = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findAll();
                
        }
        
        
        return $this->render('shop/all_products.html.twig', [
            'products' => $products,
            'form' => $form->createView()
        ]);
    }
    
    public function editor(Request $req, $id)
    {
        $product = new Product();
        $title = 'Nouveau produit';
        
        if ($id) {
            $product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->find($id);
            
            if (!$product) {
                throw $this->createNotFoundException('Ce produit n\'existe pas');
            }
            
            $title = 'Modification d\'un produit';
        } 

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {            
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            
            $this->addFlash('success', 'Produit ajouté');
            
            return $this->redirect($this->generateUrl('admin_product-editor', [
                'id' => $product->getId(),
            ]));
        }

        return $this->render('admin/product_editor.html.twig', [
            'form' => $form->createView(),
            'title' => $title,
        ]);
    }

    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
       
        $product = $em->getRepository(Product::class)->find($id);
        
        $em->persist($product);
        $em->flush();

        $this->addFlash('success', 'Produit supprimé');

        return $this->redirectToRoute('admin_index');
    }
}
