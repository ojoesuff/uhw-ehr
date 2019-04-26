<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserStaff;
use App\Entity\Appointment;
use App\Entity\Patient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\JsonResponse; 

class AppointmentBackend extends AbstractController {
    /**
     * @Route("/backend/appointment", name="appointment_backend") methods={"GET", "POST"}
     */

     public function index() {

         $request = Request::createFromGlobals();

         $entityManager = $this->getDoctrine()->getManager();

         $type = $request->request->get('type');

         $patientId = $request->request->get("patientId");

         $patient = $entityManager->getRepository(Patient::class)->findOneBy([
            "id" => $patientId
        ]);

         switch($type) {
             case "getUpcomingAppointments":           

                if($patient) {
                    $appointments = $patient->getAppointments();

                    if(sizeof($appointments) > 0) {                        
                        $appointmentsArray = array("upcomingAppointments" => array(), 
                        "completedAppointments" => array());
                        foreach($appointments as $appointment) {
                            $appointmentId = $appointment->getId();
                            $department = $appointment->getDepartment();
                            $departmentName = $department->getName();
                            $staff = $appointment->getStaffId();
                            $staffFirstName = $staff->getFirstName();
                            $staffLastName = $staff->getLastName();
                            if(!$staffLastName) {
                                $staffLastName = "";
                            }
                            $staffName = $staffFirstName." ".$staffFirstName;
                            $staffRole = $staff->getStaffType();
                            switch($staffRole) {
                                case "ROLE-NURSE":
                                    $staffType = "Nurse";
                                    break;
                                case "ROLE-DOCTOR":
                                    $staffType = "Dr";
                                    break;
                                default: 
                                    $staffType = "";
                            }
                            $dueDate = $appointment->getDate();
                            $date = $dueDate->format("d M Y");
                            $time = $dueDate->format("H:i");                            
                            
                            $appointmentArray = array("appointmentId" => $appointmentId, "departmentName" => $departmentName,
                            "date" => $date, "time" => $time, "staffName"=> $staffName, "staffType" => $staffType);

                            //organise appointments based on complete status
                            $completed = $appointment->getComplete();
                            if($completed) {
                                array_push($appointmentsArray["completedAppointments"], $appointmentArray); 
                            } else {
                                array_push($appointmentsArray["upcomingAppointments"], $appointmentArray);
                            }
                                   
                        } //end for each

                        return new JsonResponse($appointmentsArray);                    
                    } //end if
                
            } //end if

            case "getAppointment":
                $appointmentId = $request->get("appointmentId");
                $appointment = $entityManager->getRepository(Appointment::class)->findOneBy([
                    "id" => $appointmentId
                ]);

                if($appointment) {
                    $department = $appointment->getDepartment();
                    $departmentName = $department->getName();
                    $staff = $appointment->getStaffId();
                    $staffId = $staff->getId();
                    $staffFirstName = $staff->getFirstName();
                    $staffLastName = $staff->getLastName();
                    if(!$staffLastName) {
                        $staffLastName = "";
                    }
                    $staffRole = $staff->getStaffType();
                    switch($staffRole) {
                        case "ROLE-NURSE":
                            $staffType = "Nurse";
                            break;
                        case "ROLE-DOCTOR":
                            $staffType = "Dr";
                            break;
                        default: 
                            $staffType = "";
                    }
                    $staffName = $staffFirstName." ".$staffFirstName;
                    $dueDate = $appointment->getDate();
                    $date = $dueDate->format("d M Y");
                    $formattedDate = $dueDate->format("Y-m-d");
                    $time = $dueDate->format("H:i"); 
                    $status = $appointment->getStatus();
                    $complete = $appointment->getComplete();


                    $appointmentArray = array("departmentName" => $departmentName, "staffType" => $staffType,
                    "staffName" => $staffName, "date" => $date, "time" => $time, "staffId" => $staffId, 
                    "status" => $status, "complete" => $complete, "formattedDate" => $formattedDate);

                    return new JsonResponse($appointmentArray);
                }

                case "getAllStaff" :

                    $allStaff = $entityManager->getRepository(UserStaff::class)->getAllMedicalStaffNames();

                    if($allStaff) {
                        return new JsonResponse($allStaff);
                    } //end if
         
        } //end switch

        return new Response("none");
    } //end index
} //end AppointmentBackend