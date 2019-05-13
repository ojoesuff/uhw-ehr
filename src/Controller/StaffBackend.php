<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Patient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StaffBackend extends AbstractController {
    /**
     * @Route("/backend/staff", name="backend_staff")
     */

     public function index() {

        $request = Request::createFromGlobals();

        $entityManager = $this->getDoctrine()->getManager();

        $type = $request->request->get("type");
        
        $staffId = $request->get("staffId");

        switch($type) {
            case "getStaffDetails" :
                $staff = $entityManager->getRepository(User::class)->findOneBy([
                    "id" => $staffId
                ]);

                if($staff) {
                    $firstName = $staff->getFirstName();
                    $lastName = $staff->getLastName();
                    $username = $staff->getUsername();
                    $staffType = $staff->getRoles();

                    $staffArray = array("firstName" => $firstName,"lastName" => $lastName,
                    "username" => $username, "staffType" => $staffType);

                    return new JsonResponse($staffArray);
                } //end if
            case "updateStaff":
                $firstName = $request->request->get('firstName');
                $lastName = $request->request->get('lastName');
                if($lastName === null) {
                    $lastName = "";
                }
                $username = $request->request->get('username');
                $staffType = $request->request->get('staffType');

                //get user with given username that doesn't match current staff id
                $existingUser = $entityManager->getRepository(User::class)->findOneByNotId($username, $staffId);
                //if username already exists, send error
                if($existingUser) {
                    return new Response("error");
                } else {
                    $userStaff = $entityManager->getRepository(User::class)->findOneBy([
                        "id" => $staffId
                    ]);

                    if($userStaff) {
                        $userStaff->setFirstName($firstName);
                        $userStaff->setLastName($lastName);
                        $userStaff->setUsername($username);
                        $userRoles = [$staffType];
                        $userStaff->setRoles($userRoles);
    
                        $entityManager->flush();
                        
                        return new Response("success");
                    }
                    
                }  //end if/else             
                break;
            case "deleteStaff":
                $staff = $entityManager->getRepository(User::class)->findOneBy([
                    "id" => $staffId
                ]);

                if($staff) {
                    $this->deleteStaff($staff);
                    $entityManager->flush();

                    return new Response("success");
                }
            case "getLastViewedPatient":
                $staff = $entityManager->getRepository(User::class)->findOneBy([
                    "id" => $staffId
                ]);

                if($staff) {
                    $lastPatient = $staff->getLastPatient();
                    //if there is last patient data
                    if($lastPatient) {
                        $patientId = $lastPatient->getId();
                        $firstName = $lastPatient->getFirstName();
                        $lastName = $lastPatient->getLastName();
                        $patientName = $firstName." ".$lastName;
                        $patientArray = array("patientId"=> $patientId, "patientName" => $patientName);
    
                        return new JsonResponse($patientArray);
                    } 
                } else {
                    throw new NotFoundHttpException('Error: staff ID not found');
                }
            case "savePatientLastViewed":
                $staff = $entityManager->getRepository(User::class)->findOneBy([
                    "id" => $staffId
                ]);
                $patientId = $request->get("patientId");


                if($staff) {          
                    $patient = $entityManager->getRepository(Patient::class)->findOneBy([
                        "id" => $patientId
                    ]);
                    if($patient) {
                        //persist to DB
                        $staff->setLastPatient($patient);
                        $entityManager->persist($staff);
                        $entityManager->flush();                                
                    } 
                        
                } else {
                    throw new NotFoundHttpException('Error: staff ID not found');
                }

            case "deleteManyStaff":

                $staffArray = $request->get("staffArray");

                foreach($staffArray as $staffId) {
                    $staff = $entityManager->getRepository(User::class)->findOneBy([
                        "id" => $staffId
                    ]);
                    if($staff) {
                        $this->deleteStaff($staff);
                    } //end if
                } //end foreach

                $entityManager->flush();
                return new Response ("success");              

        } //end switch

        return new Response ("none");

     } //end index

     public function deleteStaff($staff) {
        $entityManager = $this->getDoctrine()->getManager();
        //get all records and appointments assocated with user and set staff id to null
        $macularClinicRecords = $staff->getMacularClinicRecords();
        if($macularClinicRecords) {
            foreach($macularClinicRecords as $macularClinicRecord) {
                $macularClinicRecord->setStaffId(NULL);
             }
        }
        $aAndERecords = $staff->getAAndERecords();
        if($aAndERecords) {
            foreach($aAndERecords as $aAndERecord) {
                $aAndERecord->setStaffId(NULL);
             }
        }
        $radiologyRecords = $staff->getRadiologyRecords();
        if($radiologyRecords) {
            foreach($radiologyRecords as $radiologyRecord) {
                $radiologyRecord->setStaffId(NULL);
             }
        }
        $appointments = $staff->getAppointments();
        if($appointments) {
            foreach($appointments as $appointment) {
                $appointment->setStaffId(NULL);
             }
        }
        $entityManager->remove($staff);
     }

} //end StaffBackend