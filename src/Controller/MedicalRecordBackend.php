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
                
                case "createRadiologyRecord":

                    $area = $request->get("area");
                    $xrayType = $request->get("xrayType");
                    $contrast = $request->get("contrast");
                    $side = $request->get("side");
                    $pacemaker = $request->get("pacemaker");
                    $sedation = $request->get("sedation");
                    $claustrophobia = $request->get("claustrophobia");
                    $metal = $request->get("metal");
                    $metalArea = $request->get("metalArea");
                    $notes = $request->get("notes");
                    $dateCreated = date_create();

                    //set radiology record data
                    $record = new RadiologyRecord();

                    $record->setArea($area);
                    $record->setXrayType($xrayType);
                    $record->setContrast($contrast);
                    $record->setSide($side);
                    $record->setPacemaker($pacemaker);
                    $record->setSedation($sedation);
                    $record->setClaustrophobia($claustrophobia);
                    $record->setMetal($metal);
                    $record->setMetalArea($metalArea);
                    $record->setNotes($notes);
                    $record->setDateCreated($dateCreated);
                    $record->setPatientId($patient);
                    //placeholder staff id
                    $staffId = $entityManager->getRepository(UserStaff::class)->findOneBy([
                        "id" => 1
                    ]);
                    $record->setStaffId($staffId);

                    $entityManager->persist($record);

                    $entityManager->flush();
                    
                    return new Response("success");
                    break;

                case "createMacularRecord":

                    $LVARangeWeeks = $request->get("LVARangeWeeks");
                    $LVARangeMonths = $request->get("LVARangeMonths");
                    $testRequired = $request->get("testRequired");
                    $surgery = $request->get("surgery");
                    $notes = $request->get("notes");
                    $dateCreated = date_create();

                    $record = new MacularClinicRecord();

                    $record->setLVARangeWeeks($LVARangeWeeks);
                    $record->setLVARangeMonths($LVARangeWeeks);
                    $record->setTestRequired($testRequired);
                    $record->setSurgery($surgery);
                    $record->setNotes($notes);                    
                    $record->setDateCreated($dateCreated);
                    $record->setPatientId($patient);
                    //placeholder staff id
                    $staffId = $entityManager->getRepository(UserStaff::class)->findOneBy([
                        "id" => 1
                    ]);
                    $record->setStaffId($staffId);

                    $entityManager->persist($record);
                    $entityManager->flush();

                    return new Response("success");
                    break;

                case "getMedicalRecords":

                    $aAndERecords = $patient->getAAndERecords();
                    $radiologyRecords = $patient->getRadiologyRecords();
                    $macularRecords = $patient->getMacularClinicRecords();

                    $recordsArray = array();

                    //send to front end with headings
                    if($aAndERecords) {
                        $allAAndERecords = $this->getMedicalRecordDetails($aAndERecords);

                        $recordsArray["aAndERecords"] = $allAAndERecords;
                    } //end if
                    if($radiologyRecords) {
                        $allRadiologyRecords = $this->getMedicalRecordDetails($radiologyRecords);

                        $recordsArray["radiologyRecords"] = $allRadiologyRecords;
                    } //end if
                    if($macularRecords) {
                        $allMacularRecords = $this->getMedicalRecordDetails($macularRecords);

                        $recordsArray["macularRecords"] = $allMacularRecords;
                    } //end if

                    return new JsonResponse($recordsArray);
                    break;
                case "viewMacularRecord":
                    
                    $recordId = $request->get("recordId");

                    $record = $entityManager->getRepository(MacularClinicRecord::class)->findOneBy([
                        "id" => $recordId
                    ]);

                    if($record) {
                        $date = $record->getDateCreated();
                        $dateCreated = $date->format("d M Y, h:m");
                        $staff = $record->getStaffId();
                        $firstName = $staff->getFirstName();
                        $lastName = $staff->getLastName();
                        $createdBy = $firstName." ".$lastName;
                        $LVARangeWeeks = $record->getLVARangeWeeks();
                        $LVARangeMonths = $record->getLVARangeMonths();
                        $testRequired = $record->getTestRequired();
                        $surgery = $record->getSurgery();
                        $notes = $record->getNotes();

                        $recordArray = array("dateCreated" => $dateCreated, "dateCreated" => $dateCreated,
                        "createdBy" => $createdBy, "LVARangeWeeks" => $LVARangeWeeks,
                        "LVARangeMonths" => $LVARangeMonths, "testRequired" => $testRequired,
                        "surgery" => $surgery, "notes" => $notes);

                        return new JsonResponse($recordArray);
                        
                    } 


            } //end switch
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

     function getMedicalRecordDetails($records) {
        $recordsArray = array();
        foreach($records as $record) {
            $recordId = $record->getId();
            $medicalStaff = $record->getStaffId();
            $firstName = $medicalStaff->getFirstName();
            $lastName = $medicalStaff->getLastName();
            $staffName = $firstName." ".$lastName;
            $dateCreated = $record->getDateCreated();
            $date = $dateCreated->format("d M Y");
            $time = $dateCreated->format("H:i");

            $recordArray = array("recordId" => $recordId, 
            "date" => $date, "time" => $time, "staffName" => $staffName);

            array_push($recordsArray, $recordArray);
        } //end foreach

        return $recordsArray;
     } //end getMedicalRecordDetails
     


}