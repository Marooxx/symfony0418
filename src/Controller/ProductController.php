<?php

namespace App\Controller;

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
        // Récupération des produits
        // Envoi des produits à la vue
        return $this->render("products/list.html.twig");
    }
}





