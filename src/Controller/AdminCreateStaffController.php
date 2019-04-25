<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route; 

class AdminCreateStaffController extends AbstractController {
    /**
     * @Route("/admin/create/staff", name="admin-create-staff")
     */

     public function create() {
         return $this->render('admin-create-staff.html.twig');
     }
}