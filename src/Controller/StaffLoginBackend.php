<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserStaff;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\RedirectResponse;

class StaffLoginBackend extends AbstractController {
    /**
     * @Route("/backend/staff/login", name="login") methods={"GET", "POST"}
     */

     public function loginStaff() {

        $request = Request::createFromGlobals();

        $username = $request->request->get('username', 'none');
        $password = $request->request->get('password', 'none');

        $repo = $this->getDoctrine()->getRepository(UserStaff::class)->findOneBy([
            'username' => $username,
            'staffPassword' => $password,
        ]);

        if($repo) {
            return new Response(
                "true"
            );
        } else {
            return new Response(
                "false"
            );
        }
     }
}