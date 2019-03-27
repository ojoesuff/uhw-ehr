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
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $middleNames;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="array")
     */
    private $address = [];

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $county;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eircode;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="string", length=30, options={"default" : "Pending"})
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=20, options={"default" : "Low"})
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
     * @ORM\OneToMany(targetEntity="App\Entity\Appointment", mappedBy="patientId")
     */
    private $appointments;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Department", inversedBy="patient", cascade={"persist", "remove"})
     */
    private $departmentId;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
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
        return $this->address;
    }

    public function setAddress(array $address): self
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

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

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

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
            $appointment->setPatientId($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->contains($appointment)) {
            $this->appointments->removeElement($appointment);
            // set the owning side to null (unless already changed)
            if ($appointment->getPatientId() === $this) {
                $appointment->setPatientId(null);
            }
        }

        return $this;
    }

    public function getDepartmentId(): ?department
    {
        return $this->departmentId;
    }

    public function setDepartmentId(?department $departmentId): self
    {
        $this->departmentId = $departmentId;

        return $this;
    }
}