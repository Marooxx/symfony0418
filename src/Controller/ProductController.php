<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
    public function add(Request $request): Response
    {
        /* Construction du formulaire */
        // Création du produit en mémoire
        $product = new Product();
        // Récupération du formulaire
        $formAdd = $this->createForm(ProductType::class, $product);

        $formAdd->handleRequest($request);

        //// Vérifier que le formulaire est envoyé et valide
        if($formAdd->isSubmitted() && $formAdd->isValid()) {
            // Si le formulaire est valide : on ajoute le produit en BDD, on affiche une notification
            /* Sauvegarde du produit en base de données */
            // Stocker les données du formulaire dans un objet Product
            $product = $formAdd->getData();
            // Récupération du manager (il exécutera le SQL)
            $manager = $this->getDoctrine()->getManager();
            // On prépare la requête SQL
            $manager->persist($product);
            // On exécute la requête SQL
            $manager->flush();

            // Ajout du message flash en session (notification pour l'utilisateur)
            $this->addFlash('notice', 'Le produit a bien été ajouté');
            // Redirection vers la liste des produits
            return $this->redirectToRoute('app_product_list');

        }
        // Si le formulaire n'est pas valide: on affiche le formulaire
        return $this->render('products/add.html.twig', [
            "formAdd" => $formAdd->createView()
        ]);
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
        /* Incrémentation du nombre de vues */
        // Récupérer le manager
        $manager = $this->getDoctrine()->getManager();
        // Mise à jour (en mémoire)
        $currentNbViews = $product->getNbViews();
        $product->setNbViews($currentNbViews + 1);
        // Enregistrement
        $manager->flush();

        return $this->render("products/show.html.twig", compact('product'));
    }

    /**
     * @Route("/produit/edit/{id}", requirements={"id"="\d+"})
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product): Response
    {
        /* Incrémentation du nombre de vues */
        // Récupérer le manager
        $manager = $this->getDoctrine()->getManager();
        // Mise à jour (en mémoire)
        $currentNbViews = $product->getNbViews();
        $product->setNbViews($currentNbViews + 1);
        // Enregistrement
        $manager->flush();

        return $this->render('products/show.html.twig', compact('product'));
    }

    /**
     * @Route("/produit/suppression/{id}", requirements={"id"="\d+"})
     * @param Product $product
     * @return Response
     */
    public function delete(Product $product): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($product);
        $manager->flush();

        return $this->redirectToRoute('app_product_list');
    }
}










