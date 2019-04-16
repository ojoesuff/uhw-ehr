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

                $patientsArray = $this->filterPatientSearch($patients);

                return new JsonResponse($patientsArray);
            } else {
                return new Response("none");
            }           
        }

        if($type === "advancedSearch") {

            $firstName = $request->request->get('firstName');
            $middleNames = $request->request->get('middleNames');
            $lastName = $request->request->get('lastName');
            $email = $request->request->get('email');
            $addressLine1 = $request->request->get('addressLine1');
            $addressLine2 = $request->request->get('addressLine2');
            $addressLine3 = $request->request->get('addressLine3');
            //convert to DateTime object
            $dob = date_create($request->request->get('dob')); 
            $dobDefault = date_create("1000-01-01");
            $patientId = $request->request->get("patientId");

            //check if any fields have a value in them before quering DB
            if(!empty($firstName) or !empty($middleNames) or !empty($lastName) or !empty($email) or !empty($patientId)
            or !empty($addressLine1) or !empty($addressLine2) or !empty($addressLine3) or $dob > $dobDefault) {
                
                $patients = $entityManager->getRepository(Patient::class)->findPatientsAdvanced($firstName, 
                $middleNames, $lastName, $email, $addressLine1, $addressLine2, $addressLine3, $dob, $patientId);

                 if($patients) {

                    $patientsArray = $this->filterPatientSearch($patients);

                    return new JsonResponse($patientsArray);
                } else {
                    return new Response("none");
                } 
            } else {
                return new Response("none");
            }

            
        }

        return new Response("default");

     }

     public function filterPatientSearch($patients) {

        $patientsArray = array();

        foreach($patients as $patient) {
            
            $id = $patient->getId();
            $firstName = $patient->getFirstName();
            $middleNames = $patient->getMiddleNames();
            $lastName = $patient->getLastName();
            $address  = $patient->getAddress();
            $county  = $patient->getCounty();
            
            $onePatient = array("id" => $id, "firstName" => $firstName, 
            "middleNames" => $middleNames, "lastName" => $lastName, 
            "address" => $address, "county" => $county);

            array_push($patientsArray, $onePatient);
        }

        return $patientsArray;
     }


}