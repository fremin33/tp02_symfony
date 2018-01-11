<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Produit;
use AppBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Categorie;
use Doctrine\ORM\EntityManager;

class LoadInformation implements FixtureInterface
{

    // Dans l'argument de la méthode load, manager est le gestionnaire d'entité
    public function load(ObjectManager $manager)
    {

        // Liste des noms de categories à ajouter
        $categories = [
            'Alimentation',
            'Informatique',
            'Plaisir',
            'Voyage',
            'Réseau',
            'Jeux-vidéos',
            'Alimentaire'
        ];


        foreach ($categories as $name) {
            // On crée la categorie
            $categorie = new Categorie();
            $categorie->setNom($name);
            // On la fait persister
            $manager->persist($categorie);
        }
        // Liste des noms de categories à ajouter
        $tags = [
            'tag01',
            'tag02',
            'tag03',
            'tag04',
            'tag05',
            'tag06',
            'tag07'
        ];

        foreach ($tags as $name) {
            // On crée le tag
            $tag = new Tag();
            $tag->setNom($name);
            // On la fait persister
            $manager->persist($tag);
        }

        $nameProduit = [
            'produit01',
            'produit02',
            'produit03',
            'produit04',
            'produit05',
            'produit06',
            'produit07',
            'produit08',
            'produit09',
            'produit10',
            'produit11',
            'produit12',
            'produit13',
            'produit14',
            'produit15',
        ];

        foreach ($nameProduit as $name) {
            $produit = new Produit();
            $produit->setNom($name);
            $produit->setDescription('blablabla');
            $produit->setImage($name);
            $CategorieRepository = $manager->getRepository(Categorie::class);
            $categories = $CategorieRepository->findAll();        }
        // On déclenche l'enregistrement de toutes les objets
        $manager->flush();
    }
}