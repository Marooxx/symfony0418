<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce contrôleur gère le CRUD du produit
 */
class ProductController extends Controller
{
    /**
     * Ajoute un produit en base de données
     * @Route("/produit/ajout")
     * @return Response
     */
    public function add(): Response
    {
        //// Vérifie la formulaire envoyé
        // Si le formulaire est valide : on ajout le produit en BDD, on affiche une notification

        // Création du produit en mémoire
        $product = new Product();
        $product
            ->setName("Banjo")
            ->setDescription('Instrument de musique rigolo')
            ->setPrice(1500);

        /* Sauvegarde du produit en base de données */
        // Récupération du manager (il exécutera le SQL)
        $manager = $this->getDoctrine()->getManager();
        // On prépare la requête SQL
        $manager->persist($product);
        // On exécute la requête SQL
        $manager->flush();

        $this->addFlash('notice', 'Le produit a bien été ajouté');
        return $this->redirectToRoute('app_product_list');
        // Si le formulaire n'est pas valide: on affiche le formulaire
    }

    /**
     * Liste les produits existants
     * @Route("/produits", name="app_product_list")
     * @return Response
     */
    public function list(): Response
    {
        /* Récupération des produits */
        // Récupération du repository
        $repository = $this->getDoctrine()->getRepository(Product::class);
        // Récupération des enregistrements
        $products = $repository->findAll();

        // Envoi des produits à la vue
        return $this->render("products/list.html.twig", compact('products'));
        /*
         * Forme équivalente
        return $this->render("products/list.html.twig", [
            "products" => $products
        ]);
        */
    }

    /**
     * @Route("/produit/{id}", requirements={"id"="\d+"})
     * @param Product $product
     * @return Response
     */
    public function show(Product $product): Response
    {
        return $this->render("products/show.html.twig", compact('product'));
    }
}










