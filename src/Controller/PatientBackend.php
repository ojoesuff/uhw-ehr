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

         $entityManager = $this->getDoctrine()->getManager();

         if($type === "details") {

            $patientId = $request->request->get('patientId');     

            $patient = $entityManager->getRepository(Patient::class)->findOneBy([
               "id" => $patientId
            ]);
            
            if($patient) {
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

               return new JsonResponse($patientDetails);
            }

            return new Response("No patient records found");
 
         }

         if($type === "outstandingAppoint") {

            $patientId = $request->request->get('patientId');

            $outstandingAppointments = $entityManager->getRepository(Appointment::class)->getTwoMostRecentOutstandingApp($patientId);

            $twoAppointments = array("outstandingAppointments" => array());

            if($outstandingAppointments) {
               foreach($outstandingAppointments as $appointment) {
                  $appointmentId = $appointment->getId();
                  $department = $appointment->getDepartment();
                  $departmentName = $department->getName();
                  $dueDate = $appointment->getDate();
                  $date = $dueDate->format("d M Y");
                  $time = $dueDate->format("H:i");
                  $medicalStaff = $appointment->getMedicalStaff();
                  
                  $appointmentArray = array("appointmentId" => $appointmentId, "departmentName" => $departmentName,
                  "date" => $date, "time" => $time, "medicalStaff" => $medicalStaff);

                  array_push($twoAppointments["outstandingAppointments"], $appointmentArray);
                  
               }

               return new JsonResponse($twoAppointments);
            }
            return new Response("none");
         }

         if($type === "completeAppoint") {

            $patientId = $request->request->get('patientId');

            $completedAppointments = $entityManager->getRepository(Appointment::class)->getThreeCompletedApps($patientId);

            $threeAppointments = array("completedAppointments" => array());

            if($completedAppointments) {
               foreach($completedAppointments as $appointment) {
                  $appointmentId = $appointment->getId();
                  $department = $appointment->getDepartment();
                  $departmentName = $department->getName();
                  $dueDate = $appointment->getDate();
                  $date = $dueDate->format("d M Y");
                  $time = $dueDate->format("H:i");
                  $medicalStaff = $appointment->getMedicalStaff();
                  
                  $appointmentArray = array("appointmentId" => $appointmentId, "departmentName" => $departmentName,
                  "date" => $date, "time" => $time, "medicalStaff" => $medicalStaff);

                  array_push($threeAppointments["completedAppointments"], $appointmentArray);                  
                  
               }

               return new JsonResponse($threeAppointments);
               
            }
            return new Response("none");
         }

        return new Response("Success");
     }
}