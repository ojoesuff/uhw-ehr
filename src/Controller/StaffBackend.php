<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
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
                        $userRoles = [$staffId];
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
                    $entityManager->remove($staff);
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
                

        } //end switch

        return new Response ("none");

     } //end index

} //end StaffBackend