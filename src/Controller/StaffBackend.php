<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserStaff;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\JsonResponse; 

class StaffBackend extends AbstractController {
    /**
     * @Route("/backend/staff", name="backend_staff")
     */

     public function index() {

        $request = Request::createFromGlobals();

        $entityManager = $this->getDoctrine()->getManager();

        $type = $request->request->get("type");

        switch($type) {
            case "getStaffDetails" :
                $staffId = $request->get("staffId");
                $staff = $entityManager->getRepository(UserStaff::class)->findOneBy([
                    "id" => $staffId
                ]);

                if($staff) {
                    $firstName = $staff->getFirstName();
                    $lastName = $staff->getLastName();
                    $username = $staff->getUsername();
                    $staffType = $staff->getStaffType();

                    $staffArray = array("firstName" => $firstName,"lastName" => $lastName,
                    "username" => $username, "staffType" => $staffType);

                    return new JsonResponse($staffArray);
                }
        }

        return new Response ("none");

     } //end index

} //end StaffBackend