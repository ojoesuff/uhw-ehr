<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AAndERecordRepository")
 */
class AAndERecord
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserStaff", inversedBy="aAndERecords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $staffId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="aAndERecords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patientId;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $notes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime")
     */
    private $arrivalDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $locationOccurred;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $injuryArea;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $typeOfInjury;

    /**
     * @ORM\Column(type="boolean")
     */
    private $xrayRequired;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vomitting;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $medication;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $medicationAmount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $surgery;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $medicationName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStaffId(): ?UserStaff
    {
        return $this->staffId;
    }

    public function setStaffId(?UserStaff $staffId): self
    {
        $this->staffId = $staffId;

        return $this;
    }

    public function getPatientId(): ?Patient
    {
        return $this->patientId;
    }

    public function setPatientId(?Patient $patientId): self
    {
        $this->patientId = $patientId;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(\DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getLocationOccurred(): ?string
    {
        return $this->locationOccurred;
    }

    public function setLocationOccurred(string $locationOccurred): self
    {
        $this->locationOccurred = $locationOccurred;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getInjuryArea(): ?string
    {
        return $this->injuryArea;
    }

    public function setInjuryArea(string $injuryArea): self
    {
        $this->injuryArea = $injuryArea;

        return $this;
    }

    public function getTypeOfInjury(): ?string
    {
        return $this->typeOfInjury;
    }

    public function setTypeOfInjury(string $typeOfInjury): self
    {
        $this->typeOfInjury = $typeOfInjury;

        return $this;
    }

    public function getXrayRequired(): ?bool
    {
        return $this->xrayRequired;
    }

    public function setXrayRequired(bool $xrayRequired): self
    {
        $this->xrayRequired = $xrayRequired;

        return $this;
    }

    public function getVomitting(): ?bool
    {
        return $this->vomitting;
    }

    public function setVomitting(bool $vomitting): self
    {
        $this->vomitting = $vomitting;

        return $this;
    }

    public function getMedication(): ?string
    {
        return $this->medication;
    }

    public function setMedication(string $medication): self
    {
        $this->medication = $medication;

        return $this;
    }

    public function getMedicationAmount(): ?string
    {
        return $this->medicationAmount;
    }

    public function setMedicationAmount(?string $medicationAmount): self
    {
        $this->medicationAmount = $medicationAmount;

        return $this;
    }

    public function getSurgery(): ?bool
    {
        return $this->surgery;
    }

    public function setSurgery(bool $surgery): self
    {
        $this->surgery = $surgery;

        return $this;
    }

    public function getMedicationName(): ?string
    {
        return $this->medicationName;
    }

    public function setMedicationName(?string $medicationName): self
    {
        $this->medicationName = $medicationName;

        return $this;
    }
}
