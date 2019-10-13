<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function loadLogin(AuthenticationUtils $authUtils)
    {
        $e = $authUtils->getLastAuthenticationError();
        if ($this->isGranted("ROLE_USER")) return $this->redirectToRoute("index");
        return $this->render("auth/login.html.twig", [ "error" => $e ]);
    }

    /**
     * @Route("/register", name="register")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function loadRegister()
    {
        return $this->render("auth/register.html.twig");
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        return new Response("Logging off", 200);
    }

}
