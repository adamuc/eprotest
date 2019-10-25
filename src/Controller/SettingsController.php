<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SettingsController extends Controller
{
    /**
     * @Route("/settings", name="settings")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function loadForum()
    {
        return $this->render("settings/index.html.twig");
    }
}
