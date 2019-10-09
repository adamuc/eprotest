<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AuthController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function loadLogin()
    {
        return $this->render("login/login.html.twig");
    }
}
