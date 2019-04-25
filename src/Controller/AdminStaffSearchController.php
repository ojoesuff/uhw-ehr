<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminStaffSearchController extends AbstractController
{
    /**
     * @Route("/admin/staff/search", name="admin_staff_search")
     */
    public function index()
    {
        return $this->render('admin-staff-search.html.twig');
    }
}
