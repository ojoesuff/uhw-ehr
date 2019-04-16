<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $middleNames;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $address = [];

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $county;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $eircode;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $priority;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telNo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mobileNo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Department", inversedBy="patients")
     */
    private $department;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appointment", mappedBy="patient", orphanRemoval=true)
     */
    private $appointments;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateOfBirth;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MacularClinicRecord", mappedBy="patientId")
     */
    private $macularClinicRecords;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RadiologyRecord", mappedBy="patientId")
     */
    private $radiologyRecords;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AAndERecord", mappedBy="patientId")
     */
    private $aAndERecords;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
        $this->macularClinicRecords = new ArrayCollection();
        $this->radiologyRecords = new ArrayCollection();
        $this->aAndERecords = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMiddleNames(): ?string
    {
        return $this->middleNames;
    }

    public function setMiddleNames(?string $middleNames): self
    {
        $this->middleNames = $middleNames;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAddress(): ?array
    {
        if(!$this->address) {
            return array("" , "", "");
        }
        return $this->address;
    }

    public function setAddress(?array $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCounty(): ?string
    {
        return $this->county;
    }

    public function setCounty(?string $county): self
    {
        $this->county = $county;

        return $this;
    }

    public function getEircode(): ?string
    {
        return $this->eircode;
    }

    public function setEircode(?string $eircode): self
    {
        $this->eircode = $eircode;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getTelNo(): ?int
    {
        return $this->telNo;
    }

    public function setTelNo(?int $telNo): self
    {
        $this->telNo = $telNo;

        return $this;
    }

    public function getMobileNo(): ?int
    {
        return $this->mobileNo;
    }

    public function setMobileNo(?int $mobileNo): self
    {
        $this->mobileNo = $mobileNo;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setPatient($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->contains($appointment)) {
            $this->appointments->removeElement($appointment);
            // set the owning side to null (unless already changed)
            if ($appointment->getPatient() === $this) {
                $appointment->setPatient(null);
            }
        }

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * @return Collection|MacularClinicRecord[]
     */
    public function getMacularClinicRecords(): Collection
    {
        return $this->macularClinicRecords;
    }

    public function addMacularClinicRecord(MacularClinicRecord $macularClinicRecord): self
    {
        if (!$this->macularClinicRecords->contains($macularClinicRecord)) {
            $this->macularClinicRecords[] = $macularClinicRecord;
            $macularClinicRecord->setPatientId($this);
        }

        return $this;
    }

    public function removeMacularClinicRecord(MacularClinicRecord $macularClinicRecord): self
    {
        if ($this->macularClinicRecords->contains($macularClinicRecord)) {
            $this->macularClinicRecords->removeElement($macularClinicRecord);
            // set the owning side to null (unless already changed)
            if ($macularClinicRecord->getPatientId() === $this) {
                $macularClinicRecord->setPatientId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RadiologyRecord[]
     */
    public function getRadiologyRecords(): Collection
    {
        return $this->radiologyRecords;
    }

    public function addRadiologyRecord(RadiologyRecord $radiologyRecord): self
    {
        if (!$this->radiologyRecords->contains($radiologyRecord)) {
            $this->radiologyRecords[] = $radiologyRecord;
            $radiologyRecord->setPatientId($this);
        }

        return $this;
    }

    public function removeRadiologyRecord(RadiologyRecord $radiologyRecord): self
    {
        if ($this->radiologyRecords->contains($radiologyRecord)) {
            $this->radiologyRecords->removeElement($radiologyRecord);
            // set the owning side to null (unless already changed)
            if ($radiologyRecord->getPatientId() === $this) {
                $radiologyRecord->setPatientId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AAndERecord[]
     */
    public function getAAndERecords(): Collection
    {
        return $this->aAndERecords;
    }

    public function addAAndERecord(AAndERecord $aAndERecord): self
    {
        if (!$this->aAndERecords->contains($aAndERecord)) {
            $this->aAndERecords[] = $aAndERecord;
            $aAndERecord->setPatientId($this);
        }

        return $this;
    }

    public function removeAAndERecord(AAndERecord $aAndERecord): self
    {
        if ($this->aAndERecords->contains($aAndERecord)) {
            $this->aAndERecords->removeElement($aAndERecord);
            // set the owning side to null (unless already changed)
            if ($aAndERecord->getPatientId() === $this) {
                $aAndERecord->setPatientId(null);
            }
        }

        return $this;
    }
}
