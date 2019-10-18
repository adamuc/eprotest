<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ForumController extends Controller
{
    /**
     * @Route("/forum", name="forum")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function loadForum()
    {
        return $this->render("forum/index.html.twig");
    }
}