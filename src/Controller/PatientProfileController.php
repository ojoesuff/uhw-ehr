<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PatientProfileController extends AbstractController
{
    /**
     * @Route("/patient/profile", name="patient-profile")
     */
    public function index()
    {
        return $this->render('patient-profile.html.twig');
    }
}
