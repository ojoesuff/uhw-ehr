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

            $patients = $entityManager->getRepository(Patient::class)->findPatientsAdvanced($firstName, 
            $middleNames, $lastName, $email, $addressLine1, $addressLine2, $addressLine3, $dob);

            // $testArray = array("firstName" => $this->isEmpty($firstName), "middleNames" => $this->isEmpty($middleNames),
            // "lastName" => $this->isEmpty($lastName), "email" => $this->isEmpty($email), "addressLine1" => $this->isEmpty($addressLine1),
            // "addressLine2" => $this->isEmpty($addressLine2), "addressLine3" => $this->isEmpty($addressLine3),
            // "dob" => $this->isEmpty($dob)
            // );

            return new JsonResponse($patients);
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

     public function isEmpty($data) {
         if(empty($data)) {
            return "empty";
         } else {
             return $data;
         }
     }

}