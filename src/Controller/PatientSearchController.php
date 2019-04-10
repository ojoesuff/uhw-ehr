<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PatientSearchController extends AbstractController
{
    /**
     * @Route("/patient/search", name="patient_search")
     */
    public function index()
    {
        return $this->render('patient-search.html.twig', [
            'controller_name' => 'PatientSearchController',
        ]);
    }
}
