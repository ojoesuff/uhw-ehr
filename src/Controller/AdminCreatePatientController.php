<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route; 

class AdminCreatePatientController extends AbstractController {
    /**
     * @Route("/admin/create/patient", name="admin-create-patient")
     */

     public function create() {
         return $this->render('admin-create-patient.html.twig');
     }
}