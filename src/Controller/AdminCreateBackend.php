<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserStaff;
use App\Entity\Patient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse; 
use Symfony\Component\HttpFoundation\Response; 

class AdminCreateBackend extends AbstractController {
    /**
     * @Route("/backend/admin/create", name="create") methods={"GET", "POST"}
     */

     public function createStaff() {

         $request = Request::createFromGlobals();

         $type = $request->request->get('type');

         if($type === "user") {
            $username = $request->request->get('username');
            $password = $request->request->get('password');
            $staffType = $request->request->get('staffType');

            $entityManager = $this->getDoctrine()->getManager();

            $userStaff = new UserStaff();
            $userStaff->setUsername($username);
            $userStaff->setStaffPassword($password);
            $userStaff->setStaffType($staffType);

            $entityManager->persist($userStaff);
            $entityManager->flush(); 
         }

         if($type === "patient") {

            //get data from request
            $firstName = $request->request->get('firstName');
            $middleName = $request->request->get('middleName');
            $lastName = $request->request->get('lastName');
            $email = $request->request->get('email');
            $address = $request->request->get('address');
            $county = $request->request->get('county');
            $eircode = $request->request->get('eircode');
            $country = $request->request->get('country');
            $dateOfBirth = $request->request->get('dateOfBirth');
            $telNo = $request->request->get('telNo');
            if($telNo === "") {
               $telNo = null;
            }
            $mobileNo = $request->request->get('mobileNo');
            if($mobileNo === "") {
               $mobileNo = null;
            }

            $entityManager = $this->getDoctrine()->getManager();

            $patient = new Patient();
            $patient->setFirstName($firstName);
            $patient->setMiddleNames($middleName);
            $patient->setLastName($lastName);
            $patient->setEmail($email);
            $patient->setAddress($address);
            $patient->setCounty($county);
            $patient->setEircode($eircode);
            $patient->setCountry($country);
            // $patient->setDateOfBirth($dateOfBirth);
            $patient->setTelNo($telNo);
            $patient->setMobileNo($mobileNo);

            $entityManager->persist($patient);
            $entityManager->flush(); 

            return new Response("New Patient Created!");
         }

        

        return new Response("Success");
     }
}