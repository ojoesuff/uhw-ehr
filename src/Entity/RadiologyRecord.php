<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RadiologyRecordRepository")
 */
class RadiologyRecord
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="radiologyRecords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patientId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserStaff", inversedBy="radiologyRecords")
     * @ORM\JoinColumn(nullable=true)
     */
    private $staffId;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $area;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $xrayType;

    /**
     * @ORM\Column(type="boolean")
     */
    private $contrast;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $side;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pacemaker;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sedation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $claustrophobia;

    /**
     * @ORM\Column(type="boolean")
     */
    private $metal;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $metalArea;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $notes;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getXrayType(): ?string
    {
        return $this->xrayType;
    }

    public function setXrayType(string $xrayType): self
    {
        $this->xrayType = $xrayType;

        return $this;
    }

    public function getContrast(): ?bool
    {
        return $this->contrast;
    }

    public function setContrast(bool $contrast): self
    {
        $this->contrast = $contrast;

        return $this;
    }

    public function getSide(): ?string
    {
        return $this->side;
    }

    public function setSide(string $side): self
    {
        $this->side = $side;

        return $this;
    }

    public function getPacemaker(): ?bool
    {
        return $this->pacemaker;
    }

    public function setPacemaker(bool $pacemaker): self
    {
        $this->pacemaker = $pacemaker;

        return $this;
    }

    public function getSedation(): ?bool
    {
        return $this->sedation;
    }

    public function setSedation(bool $sedation): self
    {
        $this->sedation = $sedation;

        return $this;
    }

    public function getClaustrophobia(): ?bool
    {
        return $this->claustrophobia;
    }

    public function setClaustrophobia(bool $claustrophobia): self
    {
        $this->claustrophobia = $claustrophobia;

        return $this;
    }

    public function getMetal(): ?bool
    {
        return $this->metal;
    }

    public function setMetal(bool $metal): self
    {
        $this->metal = $metal;

        return $this;
    }

    public function getMetalArea(): ?string
    {
        return $this->metalArea;
    }

    public function setMetalArea(?string $metalArea): self
    {
        $this->metalArea = $metalArea;

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
