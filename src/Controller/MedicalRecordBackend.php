<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Patient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\JsonResponse; 

class MedicalRecordBackend extends AbstractController {
    /**
     * @Route("/backend/medical-record", name="backend_medical_record") methods={"GET", "POST"}
     */

     public function index() {

        $request = Request::createFromGlobals();

        $entityManager = $this->getDoctrine()->getManager();

        $type = $request->request->get("type");

        if($type === "getDetails") {

            $patientId = $request->request->get('patientId');

            $patient = $entityManager->getRepository(Patient::class)->findOneBy([
                "id" => $patientId
            ]);

            if($patient) {
                
                $firstName = $patient->getFirstName();
                $middleNames = $patient->getMiddleNames();
                $lastName = $patient->getLastName();

                $patientDetails = array("firstName" => $firstName,
                "middleNames" => $middleNames, "lastName" => $lastName);

                return new JsonResponse($patientDetails);
            } else {
                
                return new Response("none");
            }
        }

        return new Response("none");

     }
     


}