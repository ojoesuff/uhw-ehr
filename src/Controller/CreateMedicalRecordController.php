<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CreateMedicalRecordController extends AbstractController
{
    /**
     * @Route("/patient/medical-record/create", name="create_medical_record")
     */
    public function index()
    {
        return $this->render('medical-record-create.html.twig');
    }
}
