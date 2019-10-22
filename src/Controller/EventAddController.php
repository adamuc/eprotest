<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventAddController extends Controller
{
    /**
     * @Route("/addevent", name="addevent")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function loadForum()
    {
        return $this->render("eventAdd/index.html.twig");
    }
}
