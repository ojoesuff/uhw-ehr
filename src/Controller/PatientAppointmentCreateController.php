<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PatientAppointmentCreateController extends AbstractController
{
    /**
     * @Route("/patient/appointment/create", name="patient_appointment_create")
     */
    public function index()
    {
        return $this->render('patient-appointment-create.html.twig');
    }
}
