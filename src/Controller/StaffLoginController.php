<?php

namespace App\Controller;

use App\Entity\UserStaff;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route; //used to create custom url routes
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;


class StaffLoginController extends AbstractController {
    /**
     * @Route("/staff/login", name="staff-login") methods={"GET", "POST"}
     */

    public function index() {
        return $this->render('staff-login.html.twig');
    }

}