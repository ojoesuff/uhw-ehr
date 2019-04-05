<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Patient;
use App\Entity\Department;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\JsonResponse; 

class PatientBackend extends AbstractController {
    /**
     * @Route("/backend/patient", name="patient-backend") methods={"GET", "POST"}
     */

     public function index() {

         $request = Request::createFromGlobals();

         $type = $request->request->get('type');

         if($type === "patient") {
            $patientId = $request->request->get('patientId');

            $entityManager = $this->getDoctrine()->getManager();

            $patient = $entityManager->getRepository(Patient::class)->findOneBy([
               "id" => $patientId
            ]);
            
            if($patient) {
               //set empty array for JSON response and add to it
               $jsonResponse = array();
               //get all the patients details 
               $firstName = $patient->getFirstName();
               $middleName = $patient->getMiddleNames();
               $lastName = $patient->getLastName();
               $name = "$firstName ".($middleName ? "$middleName " : "")
               .($lastName ? "$lastName" : "");
               $departmentId = $patient->getDepartment();
               if($departmentId) {
                  $department = $departmentId->getName();
               } else {
                  $department = "Unassigned";
               }               
               $priority = $patient->getPriority();
               $status = $patient->getStatus();
               $dob = $patient->getDateOfBirth();
               $telNo = $patient->getTelNo();
               $mobileNo = $patient->getMobileNo();
               $address = $patient->getAddress();
               $county = $patient->getCounty();
               $eircode = $patient->getEircode();
               $email = $patient->getEmail();

               $patientDetails = array("details" => ["name" => $name, "id" => $patientId, "priority" => $priority,
               "status" => $status, "dob" => $dob, "department" => $department, "address" => $address,
               "telNo" => $telNo, "mobileNo" => $mobileNo,
               "county" => $county, "eircode" => $eircode, "email" => $email]);

               $appointments = $patient->getAppointments();

               array_push($jsonResponse, $patientDetails);


               return new JsonResponse($jsonResponse);
            }

            return new Response("No patient records found");
 
         }

        return new Response("Success");
     }
}