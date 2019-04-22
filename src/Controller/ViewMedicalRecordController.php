<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ViewMedicalRecordController extends AbstractController
{
    /**
     * @Route("/patient/medical-record/view", name="view_medical_record")
     */
    public function index()
    {
        return $this->render('medical-record-view.html.twig');
    }
}
