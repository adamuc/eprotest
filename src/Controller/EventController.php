<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    /**
     * @Route("/event", name="event")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function loadForum()
    {
        return $this->render("event/index.html.twig");
    }
}
