<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Appointment;
use App\Entity\Department;
use App\Entity\Patient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        if(!$patient) {
            throw $this->createNotFoundException('Requested patient could not be found');
        }

         switch($type) {
             case "getUpcomingAppointments":           

                if($patient) {
                    $appointments = $patient->getAppointments();

                    if($appointments) {                        
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
                            $staffRole = $staff->getRoles();

                            //check if roles is in roles array
                            if(in_array("ROLE_NURSE", $staffRole)) {
                                $staffType = "Nurse";
                            } else if (in_array("ROLE_DOCTOR", $staffRole)) {
                                $staffType = "Dr";
                            } else {
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
                    $staffRole = $staff->getRoles();
                    //check if roles is in roles array
                    if(in_array("ROLE_NURSE", $staffRole)) {
                        $staffType = "Nurse";
                    } else if (in_array("ROLE_DOCTOR", $staffRole)) {
                        $staffType = "Dr";
                    } else {
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

                    $allStaff = $entityManager->getRepository(User::class)->getAllMedicalStaffNames();

                    if($allStaff) {
                        return new JsonResponse($allStaff);
                    } //end if

                case "updateAppointment":
                    $appointmentId = $request->get("appointmentId");
                    $appointment = $entityManager->getRepository(Appointment::class)->findOneBy([
                        "id" => $appointmentId
                    ]);

                    if($appointment) {
                        $staffId = $request->get("staffId");
                        $complete = $request->get("complete");
                        if($complete === "Pending") {
                            $complete = 0;
                        } else {
                            $complete = 1;
                        }
                        //convert to DateTime object
                        $date = date_create($request->get("formattedDate"));
                        $status = $request->get("status");

                        $staff = $entityManager->getRepository(User::class)->findOneBy([
                            "id" => $staffId
                        ]);

                        if($staff) {
                            $appointment->setStaffId($staff);
                        }                         
                        $appointment->setComplete($complete);
                        $appointment->setDate($date);
                        $appointment->setStatus($status);

                        $entityManager->flush();

                        return new Response("success");
                    }
                case "deleteAppointment":
                    $appointmentId = $request->get("appointmentId");
                    $appointment = $entityManager->getRepository(Appointment::class)->findOneBy([
                        "id" => $appointmentId
                    ]);

                    if($appointment) {
                        $entityManager->remove($appointment);
                        $entityManager->flush();
                        return new Response("success");
                    } //end if

                case "createAppointment":

                    if($patient) {                        
                        $date = date_create($request->get("formattedDate"));
                        $status = $request->get("status");
                        $staffId = $request->get("staffId");
                        $staff = $entityManager->getRepository(User::class)->findOneBy([
                            "id" => $staffId
                        ]);
                        $departmentName = $request->get("departmentName");
                        $department = $entityManager->getRepository(Department::class)->findOneBy([
                            "name" => $departmentName
                        ]);

                        $appointment = new Appointment();

                        $appointment->setPatient($patient);
                        $appointment->setDate($date);
                        $appointment->setStatus($status);
                        //if objects exist, set to appointment object
                        if($staff) {
                            $appointment->setStaffId($staff);
                        }
                        if($department) {
                            $appointment->setDepartment($department);
                        }

                        $entityManager->persist($appointment);
                        $entityManager->flush();

                        return new Response("success");                        
                    }
         
        } //end switch

        return new Response("none");
    } //end index
} //end AppointmentBackend