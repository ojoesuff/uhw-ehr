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
               $middleNames = $patient->getMiddleNames();
               $lastName = $patient->getLastName();
               $departmentId = $patient->getDepartment();
               if($departmentId) {
                  $department = $departmentId->getName();
               } else {
                  $department = "Unassigned";
               }               
               $priority = $patient->getPriority();
               $status = $patient->getStatus();
               $date = $patient->getDateOfBirth();
               $dobDisplay = $date->format("d M Y");
               $dob = $date->format("Y-m-d");
               $telNo = $patient->getTelNo();
               $mobileNo = $patient->getMobileNo();
               $address = $patient->getAddress();
               $county = $patient->getCounty();
               $country = $patient->getCountry();
               $eircode = $patient->getEircode();
               $email = $patient->getEmail();

               $patientDetails = array("details" => ["firstName" => $firstName,
               "middleNames" => $middleNames, "lastName" => $lastName, "id" => $patientId, "priority" => $priority,
               "status" => $status, "dobDisplay" => $dobDisplay, "department" => $department, "address" => $address,
               "telNo" => $telNo, "mobileNo" => $mobileNo, "dob" => $dob,
               "county" => $county, "country" => $country, "eircode" => $eircode, "email" => $email]);        

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

         if($type === "updateDetails") {

            $patientId = $request->request->get('patientId');
            //find patient repo with patient id
            $patient = $entityManager->getRepository(Patient::class)->findOneBy([
               "id" => $patientId
            ]);

            if($patient) {
               //get data from request            
               $firstName = $request->request->get('firstName');
               $middleName = $request->request->get('middleName');
               $lastName = $request->request->get('lastName');
               $email = $request->request->get('email');
               $address = $request->request->get('address');
               $county = $request->request->get('county');
               $eircode = $request->request->get('eircode');
               $country = $request->request->get('country');
               //convert to DateTime object
               $dateOfBirth = date_create($request->request->get('dateOfBirth'));
               $telNo = $request->request->get('telNo');
               //prevent empty string being passed to DB for number
               if($telNo === "") {
                  $telNo = null;
               }
               $mobileNo = $request->request->get('mobileNo');
               if($mobileNo === "") {
                  $mobileNo = null;
               }  
               $departmentName  = $request->request->get('department'); 
               $department = $entityManager->getRepository(Department::class)->findOneBy([
                  "name" => $departmentName
               ]);   

               if($department) {
                  $patient->setDepartment($department);
               }

               $patient->setFirstName($firstName);
               $patient->setMiddleNames($middleName);
               $patient->setLastName($lastName);
               $patient->setEmail($email);
               $patient->setAddress($address);
               $patient->setCounty($county);
               $patient->setEircode($eircode);
               $patient->setCountry($country);
               $patient->setDateOfBirth($dateOfBirth);
               $patient->setTelNo($telNo);
               $patient->setMobileNo($mobileNo);

               $entityManager->flush(); 

               return new Response("success");
            } else {
               return new Response("error");
            } //end if/else
            
         }

        return new Response("Success");
     }
}