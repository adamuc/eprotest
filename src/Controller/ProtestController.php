<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProtestController extends Controller
{
    /**
     * @Route("/protest", name="protest")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function loadProtest()
    {
        return $this->render("forum/protest.html.twig");
    }
}
