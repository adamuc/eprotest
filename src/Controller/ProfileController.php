<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function loadForum()
    {
        return $this->render("profile/index.html.twig");
    }
}
