<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Patient;
use App\Entity\Department;
use App\Entity\Appointment;
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
               $date = $patient->getDateOfBirth();
               $dob = $date->format("d M Y");
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

               //get 2 most recent appointments
               $outstandingAppointments = $entityManager->getRepository(Appointment::class)->getTwoMostRecentOutstandingApp($patientId);
               $completedAppointments = $entityManager->getRepository(Appointment::class)->getThreeCompletedApps($patientId);
               
               $outstandingAppsArray = array("outstandingAppointments" => array());
               $completedAppointmentsArray = array("completedAppointments" => array());

               if($outstandingAppsArray) {
                  foreach($outstandingAppointments as $appointment) {
                     $appointmentId = $appointment->getId();
                     $department = $appointment->getDepartment();
                     $departmentName = $department->getName();
                     $dueDate = $appointment->getDate();
                     $date = $dueDate->format("Y-m-d");
                     $time = $dueDate->format("H:i:s");
                     $medicalStaff = $appointment->getMedicalStaff();
                     
                     $appointmentArray = array("appointmentId" => $appointmentId, "departmentName" => $departmentName,
                     "date" => $date, "time" => $time, "medicalStaff" => $medicalStaff);
   
                     array_push($outstandingAppsArray["outstandingAppointments"], $appointmentArray);
                  }
               }
               if($completedAppointmentsArray) {
                  foreach($completedAppointments as $appointment) {
                     $appointmentId = $appointment->getId();
                     $department = $appointment->getDepartment();
                     $departmentName = $department->getName();
                     $dueDate = $appointment->getDate();
                     $date = $dueDate->format("Y-m-d");
                     $time = $dueDate->format("H:i:s");
                     $medicalStaff = $appointment->getMedicalStaff();
                     
                     $appointmentArray = array("appointmentId" => $appointmentId, "departmentName" => $departmentName,
                     "date" => $date, "time" => $time, "medicalStaff" => $medicalStaff);
   
                     array_push($completedAppointmentsArray["completedAppointments"], $appointmentArray);
                  }   
               }
               
               array_push($jsonResponse, $patientDetails);
               array_push($jsonResponse, $outstandingAppsArray);
               array_push($jsonResponse, $completedAppointmentsArray);


               return new JsonResponse($jsonResponse);
            }

            return new Response("No patient records found");
 
         }

        return new Response("Success");
     }
}