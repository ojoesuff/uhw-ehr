<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Patient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminCreateBackend extends AbstractController {
    /**
     * @Route("/backend/admin/create", name="create") methods={"GET", "POST"}
     */

     public function createStaff(UserPasswordEncoderInterface $encoder) {

         $request = Request::createFromGlobals();

         $entityManager = $this->getDoctrine()->getManager();

         $type = $request->request->get('type');

         switch($type) {
            case "staff":
               $firstName = $request->request->get('firstName');
               $lastName = $request->request->get('lastName');
               if($lastName === null) {
                  $lastName = "";
               }
               $username = $request->request->get('username');
               $password = $request->request->get('password');
               $roles = [$request->request->get('staffType')];

               //get user with given username
               $existingUser = $entityManager->getRepository(User::class)->findOneBy([
                  "username" => $username
               ]);

               //if username already exists, send error
               if($existingUser) {
                  return new Response("error");
               } else {
                  $userStaff = new User();
                  $userStaff->setFirstName($firstName);
                  $userStaff->setLastName($lastName);
                  $userStaff->setUsername($username);
                  //encode password
                  $encodedPassword = $encoder->encodePassword($userStaff, $password);                  
                  $userStaff->setPassword($encodedPassword);
                  $userStaff->setRoles($roles);
                  $userStaff->setAccountLocked(0);
   
                  $entityManager->persist($userStaff);
                  $entityManager->flush();
                  
                  return new Response("success");
               }               
               break;
            
            case "patient":
               $email = $request->request->get('email');
               //check if email address is unique
               $existingUser = $entityManager->getRepository(Patient::class)->findOneBy([
                  "email" => $email
               ]);

               if($existingUser) {
                  return new Response("error");
               }
               //get data from request
               $firstName = $request->request->get('firstName');
               $middleNames = $request->request->get('middleNames');
               $lastName = $request->request->get('lastName');
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

               $patient = new Patient();
               $patient->setFirstName($firstName);
               $patient->setMiddleNames($middleNames);
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

               //set default values
               $patient->setStatus('Pending');        
               $patient->setPriority('Low');

               $entityManager->persist($patient);
               $entityManager->flush(); 

               return new Response("success");
               break;

         } //end switch

        return new Response("none");
     } //end createStaff
}