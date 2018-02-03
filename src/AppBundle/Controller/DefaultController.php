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
        return $this->render('default/produit.html.twig', ['produit' => $produit]);
    }

    /**
     * @Route("/produits", name="produits")
     */
    public function produitsAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Produit::class);
        $produits = $repository->findAll();
  
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

    /**
     * Creates a new produit entity.
     *
     * @Route("/produits/ajout", name="ajoutProduit")
     */
    public function newAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm('AppBundle\Form\ProduitType', $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produits');
        }

        return $this->render('default/ajout.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Display Requete
     *
     * @Route("/requetes", name="requetes")
     */
    public function requetesAction (Request $request) {

        $em = $this->getDoctrine()->getManager();

        $produitRepository = $em->getRepository(Produit::class);
        $produits = $produitRepository->findAll();
        // Numbre de categories
        $numbCat = $em->getRepository('AppBundle:Categorie')->numberCat();
        // Numbre de produit ayant un certain tag
        $productTag = $produitRepository->getProducTag('tag07');

        $catvide = $em->getRepository('AppBundle:Categorie')->categoriesVide();
        var_dump($catvide);

        return $this->render('default/requetes.html.twig', [
            'produits' => $produits,
            'numbCat' => $numbCat,
            'productTag' => $productTag,
            'catVide' => $catvide
        ]);
    }
}