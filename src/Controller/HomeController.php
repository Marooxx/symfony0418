<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    /**
     * @Route("/index")
     * @throws \Exception
     */
    public function HomePage(): Response {

        // La ligne suivante génère une erreur 500
        //throw new \Exception('Erreur perso');

        $titreH1='Page d\'accueil numéro 2';

        return $this->render('index.html.twig', [
            'title' => $titreH1
        ]);
        
    }
    public function contact(): Response {
        
        $titreContact = "Bienvenue sur la page d'accueil";
        return $this->render('contact.html.twig',[
            'titre'=>$titreContact
        ]);
    }
    
    /** 
    *@Route("/redirige-moi")
    */
        
    public function redirige(): Response {
        
        return $this->redirectToRoute('app_home_homepage');
    }
    
    /**
     *  @Route("/blog/{nbpage}", requirements={"nbpage"="\d+"})
     */
    public function blog($nbpage): Response {
        return $this->render('blog.html.twig',[
            'page'=>$nbpage
        ]);
    }
    
    /**
     *  @Route("/blog/accueil")
     */
    public function blog2(): Response {
        return $this->render('blog2.html.twig',[
            'page'=>0
        ]);
    }
    
    
    
    
    
    
    
    
    
    
}