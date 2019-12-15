<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\Protest;
use App\Repository\UserRepository;
use App\Repository\ProtestRepository;

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

    /**
     * @param Request $request
     * @param UserRepository $userRepository
     * @param ProtestRepository $protestRepository
     * @return Symfony\Component\HttpFoundation\Response
     * @Route("/api/addProtest", methods={"POST"})
     */
    public function addProtest(Request $request, UserRepository $userRepository, ProtestRepository $protestRepository)
    {
        if ($request->request) {
            if ($this->isGranted("ROLE_USER")) {
                $user = $this->getUser();
                $form = $request->request;

                $title = trim(htmlspecialchars(strip_tags($form->get("title"))));
                $description = trim(htmlspecialchars(strip_tags($form->get("description"))));
                $date = trim(htmlspecialchars(strip_tags($form->get("date"))));
                $time = trim(htmlspecialchars(strip_tags($form->get("time"))));
                $category = trim(htmlspecialchars(strip_tags($form->get("category"))));
                $type = trim(htmlspecialchars(strip_tags($form->get("type"))));
                $location1 = trim(htmlspecialchars(strip_tags($form->get("location1"))));
                $location2 = trim(htmlspecialchars(strip_tags($form->get("location2"))));
                $endlocation = trim(htmlspecialchars(strip_tags($form->get("endlocation"))));
                $logo = $request->files->get('logo');
                $bgimage = $request->files->get('bgImage');

                $datetime = new \DateTime($date . " " . $time);

                $protest = new Protest();

                $em = $this->getDoctrine()->getManager();

                $protest->setAuthor($user->getId());
                $protest->setTitle($title);
                $protest->setDescription($description);
                $protest->setCategory($category);
                $protest->setType($type);
                $protest->setLocation1($location1);
                $protest->setLocation2($location2);
                $protest->setEndlocation($endlocation);
                $protest->setLat($lat);
                $protest->setLon($lon);
                
                $protest->setBgimage($bgimage_path);
                $protest->setDatetime($datetime);

                $hash = hash('crc32b', $title . $category . $type . $location1);

                if (!is_null($logo)) {
                    $fileDir = $this->get('kernel')->getProjectDir() . '/public/upload/logo';
                    $fileName = $title . "_" . $hash . "." . $logo->getClientOriginalExtension();
                    $url = '/upload/logo/' . $fileName;
                    $logo->move($fileDir, $fileName);
                    $protest->setLogo($url);
                }

                if (!is_null($bgimage)) {
                    $fileDir = $this->get('kernel')->getProjectDir() . '/public/upload/bgimage';
                    $fileName = $title . "_" . $hash . "." . $bgimage->getClientOriginalExtension();
                    $url = '/upload/bgimage/' . $fileName;
                    $bgimage->move($fileDir, $fileName);
                    $protest->setBgimage($url);
                }

                $em->persist($protest);
                $em->flush();
            }
        }
    }
}
