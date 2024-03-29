<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function loadIndex()
    {
        return $this->render("index/index.html.twig");
    }
}
