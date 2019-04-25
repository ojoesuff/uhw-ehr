<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PatientAppointmentAllController extends AbstractController
{
    /**
     * @Route("/patient/appointment/all", name="patient_appointments_all")
     */
    public function index()
    {
        return $this->render('patient-appointment-all.html.twig');
    }
}
