<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Patient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\JsonResponse; 

class PatientSearchBackend extends AbstractController {
    /**
     * @Route("/backend/search", name="backend_search")
     */

     public function index() {

        $request = Request::createFromGlobals();

        $entityManager = $this->getDoctrine()->getManager();

        $type = $request->request->get("type");

        if($type === "quickSearch") {

            $search = $request->request->get("search");

            $patients = $entityManager->getRepository(Patient::class)->findPatientsByName($search);

            if($patients) {

                $patientsArray = $this->filterPatientQuickSearch($patients);

                return new JsonResponse($patientsArray);
            } else {
                return new Response("none");
            }
            
            
        }

        return new Response("default");

     }

     public function filterPatientQuickSearch($patients) {

        $patientsArray = array();

        foreach($patients as $patient) {
            
            $id = $patient->getId();
            $firstName = $patient->getFirstName();
            $middleNames = $patient->getMiddleNames();
            $lastName = $patient->getLastName();
            $address  = $patient->getAddress();
            $county  = $patient->getCounty();
            
            $onePatient = array("id" => $id, "firstName" => $firstName, "middleNames" => $middleNames,
            "lastName" => $lastName, "address" => $address, "county" => $county);

            array_push($patientsArray, $onePatient);
        }

        return $patientsArray;
     }

}