<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route; 

class AdminCreateController extends AbstractController {
    /**
     * @Route("/admin/create", name="admin-create")
     */

     public function create() {
         return $this->render('admin-create.html.twig');
     }
}