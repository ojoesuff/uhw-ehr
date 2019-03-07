<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route; //used to create custom url routes

class DashboardController extends AbstractController {
    /**
     * @Route("/dashboard", name="dashboard")
     */

     public function dashboard() {
         return $this->render('dashboard.html.twig');
     }
}