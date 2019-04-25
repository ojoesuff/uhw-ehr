<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminStaffProfileController extends AbstractController
{
    /**
     * @Route("/admin/staff/profile", name="admin_staff_profile")
     */
    public function index()
    {
        return $this->render('admin-staff-profile.html.twig');
    }
}
