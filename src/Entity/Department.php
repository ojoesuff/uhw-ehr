<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartmentRepository")
 */
class Department
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Appointment", mappedBy="departmentId", cascade={"persist", "remove"})
     */
    private $appointment;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Patient", mappedBy="departmentId", cascade={"persist", "remove"})
     */
    private $patient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAppointment(): ?Appointment
    {
        return $this->appointment;
    }

    public function setAppointment(Appointment $appointment): self
    {
        $this->appointment = $appointment;

        // set the owning side of the relation if necessary
        if ($this !== $appointment->getDepartmentId()) {
            $appointment->setDepartmentId($this);
        }

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        // set (or unset) the owning side of the relation if necessary
        $newDepartmentId = $patient === null ? null : $this;
        if ($newDepartmentId !== $patient->getDepartmentId()) {
            $patient->setDepartmentId($newDepartmentId);
        }

        return $this;
    }
}
