<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Patient;
use App\Entity\AAndERecord;
use App\Entity\MacularClinicRecord;
use App\Entity\RadiologyRecord;
use App\Entity\UserStaff;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\JsonResponse; 

class MedicalRecordBackend extends AbstractController {
    /**
     * @Route("/backend/medical-record", name="backend_medical_record") methods={"GET", "POST"}
     */

     public function index() {

        $request = Request::createFromGlobals();

        $entityManager = $this->getDoctrine()->getManager();

        $type = $request->request->get("type");

        $patientId = $request->request->get('patientId');

        $patient = $entityManager->getRepository(Patient::class)->findOneBy([
            "id" => $patientId
        ]);

        if($patient) {

            switch($type) {
                case "getDetails":
                    $patientDetails = $this->getPatientDetails($patient);

                    return new JsonResponse($patientDetails);
                    break;
                case "createAAndERecord":
                    //get details from request object                
                    $locationOccurred = $request->get("locationOccurred");
                    $description = $request->get("description");
                    $injuryArea = $request->get("injuryArea");
                    $typeOfInjury = $request->get("typeOfInjury");
                    $medication = $request->get("medication");
                    $medicationName = $request->get("medicationName");
                    $medicationAmount = $request->get("medicationAmount");
                    $xrayRequired = $request->get("xrayRequired");
                    $vomitting = $request->get("vomitting");
                    $priority = $request->get("priority");
                    $surgery = $request->get("surgery");
                    $arrivalDate = date_create($request->get("arrivalDate"));                    
                    $notes = $request->get("notes");
                    //current time
                    $dateCreated = date_create();

                    //update priority if changed
                    if($priority !== $patient->getPriority()) {
                        $patient->setPriority($priority);
                        $entityManager->persist($patient);
                    }

                    //set a and e record data
                    $aAndERecord = new AAndERecord();

                    $aAndERecord->setPatientId($patient);
                    $aAndERecord->setLocationOccurred($locationOccurred);
                    $aAndERecord->setDescription($description);
                    $aAndERecord->setInjuryArea($injuryArea);
                    $aAndERecord->setTypeOfInjury($typeOfInjury);
                    $aAndERecord->setMedication($medication);
                    $aAndERecord->setMedicationAmount($medicationAmount);
                    $aAndERecord->setMedicationName($medicationName);
                    $aAndERecord->setXrayRequired($xrayRequired);
                    $aAndERecord->setVomitting($vomitting);
                    $aAndERecord->setSurgery($surgery);
                    $aAndERecord->setArrivalDate($arrivalDate);
                    $aAndERecord->setDateCreated($dateCreated);
                    $aAndERecord->setNotes($notes);

                    //placeholder staff id
                    $staffId = $entityManager->getRepository(UserStaff::class)->findOneBy([
                        "id" => 1
                    ]);

                    $aAndERecord->setStaffId($staffId);

                    $entityManager->persist($aAndERecord);
                    $entityManager->flush();

                    return new Response("success");
                    break;            

                    
            }
        } //end if/else

        return new Response("none"); 

     } //end index

    //get patient details
     function getPatientDetails($patient) {

        $firstName = $patient->getFirstName();
        $middleNames = $patient->getMiddleNames();
        $lastName = $patient->getLastName();

        $patientDetails = array("firstName" => $firstName,
        "middleNames" => $middleNames, "lastName" => $lastName);

        return $patientDetails;
    
     }
     


}