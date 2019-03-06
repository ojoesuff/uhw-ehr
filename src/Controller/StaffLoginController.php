<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route; //used to create custom url routes

class StaffLoginController extends AbstractController {
    /**
     * @Route("/staff/login", name="staff-login")
     */

     public function staffLogin() {
         return $this->render('staff-login.html.twig');
     }
}