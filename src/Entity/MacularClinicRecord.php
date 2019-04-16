<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MacularClinicRecordRepository")
 */
class MacularClinicRecord
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="integer")
     */
    private $LVARangeWeeks;

    /**
     * @ORM\Column(type="integer")
     */
    private $LVARangeMonths;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $testRequired;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $surgery;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="macularClinicRecords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patientId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserStaff", inversedBy="macularClinicRecords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $staffId;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $notes;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLVARangeWeeks(): ?int
    {
        return $this->LVARangeWeeks;
    }

    public function setLVARangeWeeks(int $LVARangeWeeks): self
    {
        $this->LVARangeWeeks = $LVARangeWeeks;

        return $this;
    }

    public function getLVARangeMonths(): ?int
    {
        return $this->LVARangeMonths;
    }

    public function setLVARangeMonths(int $LVARangeMonths): self
    {
        $this->LVARangeMonths = $LVARangeMonths;

        return $this;
    }

    public function getTestRequired(): ?string
    {
        return $this->testRequired;
    }

    public function setTestRequired(string $testRequired): self
    {
        $this->testRequired = $testRequired;

        return $this;
    }

    public function getSurgery(): ?string
    {
        return $this->surgery;
    }

    public function setSurgery(string $surgery): self
    {
        $this->surgery = $surgery;

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

    public function getStaffId(): ?UserStaff
    {
        return $this->staffId;
    }

    public function setStaffId(?UserStaff $staffId): self
    {
        $this->staffId = $staffId;

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
}
