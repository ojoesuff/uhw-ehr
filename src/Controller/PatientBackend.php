<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Patient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse; 
use Symfony\Component\HttpFoundation\Response; 

class PatientBackend extends AbstractController {
    /**
     * @Route("/backend/patient", name="patient-backend") methods={"GET", "POST"}
     */

     public function index() {

         $request = Request::createFromGlobals();

         $type = $request->request->get('type');

         if($type === "patient") {
            $patientId = $request->request->get('patientId');

            $entityManager = $this->getDoctrine()->getManager();

            $patient = $entityManager->getRepository(Patient::class)->findOneBy([
               "id" => $patientId
            ]);
            
            if($patient) {
               $firstName = $patient->getFirstName();
               $middleName = $patient->getMiddleNames();
               $lastName = $patient->getLastName();
               $name = "$firstName ".($middleName ? "$middleName " : "")
               .($lastName ? "$lastName" : "");

               return new Response($name);
            }

            return new Response("Na");

            // $entityManager->persist($userStaff);
            // $entityManager->flush(); 
         }

         if($type === "user") {

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
            //current time
            $dateCreated = date_create();
            $telNo = $request->request->get('telNo');
            //prevent empty string being passed to DB for number
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
            $patient->setDateOfBirth($dateOfBirth);
            $patient->setTelNo($telNo);
            $patient->setMobileNo($mobileNo);
            $patient->setDateCreated($dateCreated);
            

            //default value in entity being written as null when input is empty
            //below solution found at https://stackoverflow.com/questions/3376881/default-value-in-doctrine
            if ($patient->getStatus() === null) {
               $patient->setStatus('Pending');
            }
            if ($patient->getPriority() === null) {
               $patient->setPriority('Low');
            }

            //1986-05-25

            $entityManager->persist($patient);
            $entityManager->flush(); 

            return new Response("New Patient Created!");
         }

        

        return new Response("Success");
     }
}