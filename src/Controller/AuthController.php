<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;
use App\Repository\UserRepository;

class AuthController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function loadLogin(AuthenticationUtils $authUtils): Response
    {
        $e = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render("auth/login.html.twig", [ "last_username" => $lastUsername, "error" => $e ]);
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
     * @param Request $request
     * @param UserRepository $userRepository
     * @param UserPasswordEncoderInterface $encoder
     * @return Symfony\Component\HttpFoundation\Response
     * @Route("/api/register", methods={"POST"})
     */
    public function registerUser(Request $request, UserRepository $repository, UserPasswordEncoderInterface $encoder)
    {
        if ($request->request) {
            $form = $request->request;

            $username = trim(htmlspecialchars(strip_tags($form->get("username"))));
            $email = trim(htmlspecialchars(strip_tags($form->get("email"))));
            $password = htmlspecialchars(strip_tags($form->get("password")));
            $rpassword = htmlspecialchars(strip_tags($form->get("rpassword")));

            if ($username == "" || $email == "" || $password == "" || $rpassword == "") return new Response(0, 400);
            if (strlen($username) > 32 || strlen($username) < 4) return new Response(1, 400);
            if (strlen($email) > 254) return new Response(2, 400);
            if (strlen($password) > 255 || strlen($password) < 8) return new Response(3, 400);
            if ($password != $rpassword) return new Response(4, 400);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return new Response(100, 400);
            if($repository->findOneByUsername($username)) return new Response(101, 400);
            if($repository->findOneByEmail($email)) return new Response(102, 400);
            

            $user = new User();
            $datetime = new \DateTime(null, new \DateTimeZone("UTC"));
            $em = $this->getDoctrine()->getManager();

            $password = $encoder->encodePassword($user, $password);
            $confirmationCode = bin2hex(random_bytes(16));
            $roles = ["ROLE_USER"];

            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setRoles($roles);
            $user->setConfirmationcode($confirmationCode);
            $user->setRegistrationtime($datetime);

            $em->persist($user);
            $em->flush();

            $subject = "Aktywacja konta eProtest";
            $msg = "<a href=https://www.eprotest.pl/activate#" . $confirmationCode . ">Kliknij tutaj, aby aktywować swoje konto w serwisie eProtest.</a>";
            $headers[] = "MIME-Version: 1.0";
            $headers[] = "Content-type: text/html; charset=iso-8859-1";
            $headers[] = "To: <" . $email . ">";
            $headers[] = "From: eProtest Activation Service <noreply@eprotest.pl>";

            mail($email, $subject, $msg, implode("\r\n", $headers));

            return new Response(0, 200);
        }
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        return new Response("Logging off", 200);
    }

}
