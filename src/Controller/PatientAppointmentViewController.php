<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PatientAppointmentViewController extends AbstractController
{
    /**
     * @Route("/patient/appointment/view", name="patient_appointment_view")
     */
    public function index()
    {
        return $this->render('patient-appointment-view.html.twig');
    }
}
