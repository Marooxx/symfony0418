<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends Controller
{
    /**
     * @Route("/about", name="app_about")
     */
    public function about(Session $session): Response
    {
        $session->set('secret', 'Symfony c\'est presque facile');
        return $this->render('about.html.twig');
    }

    /**
     * @Route("/session")
     */
    public function sessionSecret(Session $session)
    {
        $secret = $session->get('secret') ??  'Pas de secret';

        return $this->render('session.html.twig', [
            "secret" => $secret
        ]);
    }
}