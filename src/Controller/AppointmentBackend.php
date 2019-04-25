<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserStaff;
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
                        $appointmentsArray = array();
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

                            array_push($appointmentsArray, $appointmentArray);        
                        } //end for each

                        return new JsonResponse($appointmentsArray);                    
                    } //end if
                
            } //end if
         
        } //end switch

        return new Response("none");
    } //end index
} //end AppointmentBackend