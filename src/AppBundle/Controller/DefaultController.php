<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Categorie;
use AppBundle\Form\ProduitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/produit/{produit}", requirements={"produit": "[a-zA-Z]*"}, name="produit")
     */
    public function produitAction(Request $request, $produit)
    {
        $produit = new Produit($produit, 'bablabla', 5.55);
        var_dump($produit);
        return $this->render('default/produit.html.twig', ['produit' => $produit]);
    }

    /**
     * @Route("/produits", name="produits")
     */
    public function produitsAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Produit::class);
        $produits = $repository->findAll();
  
        var_dump($produits);
        return $this->render('default/produits.html.twig', ['produits' => $produits]);
    }

    

    /**
     * @Route("/cat", name="categories")
     */
    public function categoriesAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Categorie::class);
        $categories = $repository->findAll();
        return $this->render('default/cat.html.twig', ['categories' => $categories]);
    }

//     /**
//      * @Route("/ajout", name="ajout")
//      */
//     public function addAction(Request $request)
//     {

//             $produit = new Produit();
//             $form = $this->createForm('AppBundle\Form\ProduitType', $produit);
//             $form->handleRequest($request);

//             if ($form->isSubmitted() && $form->isValid()) {
//                 $em = $this->getDoctrine()->getManager();
//                 $em->persist($produit);
//                 $em->flush();

//                 return $this->redirectToRoute('produits');
//             }

//             return $this->render('default/produits.html.twig');
        
// }
}