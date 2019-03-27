<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppointmentRepository")
 */
class Appointment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $medicalStaff = "General";

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $status;

    /**
     * @ORM\Column(type="boolean")
     */
    private $complete;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patientId;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Department", inversedBy="appointment", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $departmentId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedicalStaff(): ?string
    {
        return $this->medicalStaff;
    }

    public function setMedicalStaff(string $medicalStaff): self
    {
        $this->medicalStaff = $medicalStaff;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getComplete(): ?bool
    {
        return $this->complete;
    }

    public function setComplete(bool $complete): self
    {
        $this->complete = $complete;

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

    public function getDepartmentId(): ?Department
    {
        return $this->departmentId;
    }

    public function setDepartmentId(Department $departmentId): self
    {
        $this->departmentId = $departmentId;

        return $this;
    }
}
