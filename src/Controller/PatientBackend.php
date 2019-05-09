<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Patient;
use App\Entity\Department;
use App\Entity\Appointment;
use App\Entity\AAndERecord;
use App\Entity\MacularClinicRecord;
use App\Entity\RadiologyRecord;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PatientBackend extends AbstractController {
    /**
     * @Route("/backend/patient", name="patient-backend") methods={"GET", "POST"}
     */

     public function index() {

         $request = Request::createFromGlobals();

         $type = $request->request->get('type');

         $entityManager = $this->getDoctrine()->getManager();

         $patientId = $request->request->get('patientId');

         if($type === "deletePatient") {
            $patient = $entityManager->getRepository(Patient::class)->findOneBy([
               "id" => $patientId
            ]);

            if($patient) {
               //get all records associated with patient and delete them
               $aAndERecords = $entityManager->getRepository(AAndERecord::class)->findBy([
                  "patientId" => $patient
               ]);
               foreach($aAndERecords as $record) {
                  $entityManager->remove($record);
               }
               $macularRecords = $entityManager->getRepository(MacularClinicRecord::class)->findBy([
                  "patientId" => $patient
               ]);
               foreach($macularRecords as $record) {
                  $entityManager->remove($record);
               }
               $radiologyRecords = $entityManager->getRepository(RadiologyRecord::class)->findBy([
                  "patientId" => $patient
               ]);
               foreach($radiologyRecords as $record) {
                  $entityManager->remove($record);
               }
               $appointments = $entityManager->getRepository(Appointment::class)->findBy([
                  "patient" => $patient
               ]);
               foreach($appointments as $record) {
                  $entityManager->remove($record);
               }
               $entityManager->remove($patient);
               $entityManager->flush();

               return new Response("success");
            } else {
               throw new NotFoundHttpException('Patient not found');
            }
         }

         if($type === "details") {                 

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
            } else {
               throw new NotFoundHttpException('Patient not found');
            }
 
         }

         if($type === "outstandingAppoint") {

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
                  
                  $appointmentArray = array("appointmentId" => $appointmentId, "departmentName" => $departmentName,
                  "date" => $date, "time" => $time);

                  array_push($twoAppointments["outstandingAppointments"], $appointmentArray);
                  
               }

               return new JsonResponse($twoAppointments);
            }
            return new Response("none");
         }

         if($type === "completeAppoint") {

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
               throw new NotFoundHttpException('Patient not found');
            } //end if/else
            
         }

         if($type === "getAppointmentsByDate") {

            //convert to DateTime object
            $date = date_create($request->request->get('date'));
            //find patient repo with patient id
            $appointments = $entityManager->getRepository(Appointment::class)->getAppointmentsByDate($patientId, $date);

            $appointmentsArray = array();

            if($appointments) {
               foreach($appointments as $appointment) {
                  $appointmentId = $appointment->getId();
                  $department = $appointment->getDepartment();
                  $departmentName = $department->getName();
                  $dueDate = $appointment->getDate();
                  $date = $dueDate->format("d M Y");
                  $time = $dueDate->format("H:i");
                  $medicalStaff = $appointment->getMedicalStaff();
                  
                  $appointmentArray = array("appointmentId" => $appointmentId, "departmentName" => $departmentName,
                  "date" => $date, "time" => $time, "medicalStaff" => $medicalStaff);

                  array_push($appointmentsArray, $appointmentArray);        
               }

               return new JsonResponse($appointmentsArray);

            } else {
               return new Response("none");
            }
         }

         if($type === "appointmentHistory") {

            $appointments = $entityManager->getRepository(Appointment::class)->getAllPreviousAppoint($patientId);

            $appointmentsArray = array();

            if($appointments) {
               foreach($appointments as $appointment) {
                  $appointmentId = $appointment->getId();
                  $department = $appointment->getDepartment();
                  $departmentName = $department->getName();
                  $dueDate = $appointment->getDate();
                  $date = $dueDate->format("d M Y");
                  $time = $dueDate->format("H:i");
                  $medicalStaff = $appointment->getMedicalStaff();
                  
                  $appointmentArray = array("appointmentId" => $appointmentId, "departmentName" => $departmentName,
                  "date" => $date, "time" => $time, "medicalStaff" => $medicalStaff);

                  array_push($appointmentsArray, $appointmentArray);        
               }

               return new JsonResponse($appointmentsArray);

            } else {
               return new Response("none");
            }            
         }

        return new Response("Success");
     }
}