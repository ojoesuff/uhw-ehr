<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserStaff;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse; 
use Symfony\Component\HttpFoundation\Response; 

class AdminCreateBackend extends AbstractController {
    /**
     * @Route("/backend/admin/create", name="create") methods={"GET", "POST"}
     */

     public function createStaff() {

        $request = Request::createFromGlobals();

        $username = $request->request->get('username', 'none');
        $password = $request->request->get('password', 'none');
        $staffType = $request->request->get('staffType', 'none');

        $entityManager = $this->getDoctrine()->getManager();

        $userStaff = new UserStaff();
        $userStaff->setUsername($username);
        $userStaff->setStaffPassword($password);
        $userStaff->setStaffType($staffType);

        $entityManager->persist($userStaff);
        $entityManager->flush(); 

        return new Response("Success");
     }
}