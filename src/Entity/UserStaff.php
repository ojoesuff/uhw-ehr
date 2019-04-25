<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserStaffRepository")
 */
class UserStaff
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\SequenceGenerator(sequenceName="id", initialValue=0000001)
     * @Assert\NotBlank(message = "Enter a username")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Enter a password")
     */
    private $staffPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $staffType;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accountLocked = 0;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MacularClinicRecord", mappedBy="staffId")
     */
    private $macularClinicRecords;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RadiologyRecord", mappedBy="staffId")
     */
    private $radiologyRecords;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AAndERecord", mappedBy="staffId")
     */
    private $aAndERecords;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appointment", mappedBy="staffId")
     */
    private $appointments;

    public function __construct()
    {
        $this->macularClinicRecords = new ArrayCollection();
        $this->radiologyRecords = new ArrayCollection();
        $this->aAndERecords = new ArrayCollection();
        $this->appointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getStaffPassword(): ?string
    {
        return $this->staffPassword;
    }

    //php function for hashing password with bcrypt and auto salt genaration - default cost = 10
    public function hashPassword(string $staffPassword) : ?string 
    {
        $hashedPassword = password_hash($staffPassword, PASSWORD_DEFAULT);

        return $hashedPassword;
    }

    public function setStaffPassword(string $staffPassword): self
    {
        $this->staffPassword = password_hash($staffPassword, PASSWORD_DEFAULT);

        return $this;
    }

    public function getStaffType(): ?string
    {
        return $this->staffType;
    }

    public function setStaffType(string $staffType): self
    {
        $this->staffType = $staffType;

        return $this;
    }

    public function getAccountLocked(): ?bool
    {
        return $this->accountLocked;
    }

    public function setAccountLocked(bool $accountLocked): self
    {
        $this->accountLocked = $accountLocked;

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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

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
            $macularClinicRecord->setStaffId($this);
        }

        return $this;
    }

    public function removeMacularClinicRecord(MacularClinicRecord $macularClinicRecord): self
    {
        if ($this->macularClinicRecords->contains($macularClinicRecord)) {
            $this->macularClinicRecords->removeElement($macularClinicRecord);
            // set the owning side to null (unless already changed)
            if ($macularClinicRecord->getStaffId() === $this) {
                $macularClinicRecord->setStaffId(null);
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
            $radiologyRecord->setStaffId($this);
        }

        return $this;
    }

    public function removeRadiologyRecord(RadiologyRecord $radiologyRecord): self
    {
        if ($this->radiologyRecords->contains($radiologyRecord)) {
            $this->radiologyRecords->removeElement($radiologyRecord);
            // set the owning side to null (unless already changed)
            if ($radiologyRecord->getStaffId() === $this) {
                $radiologyRecord->setStaffId(null);
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
            $aAndERecord->setStaffId($this);
        }

        return $this;
    }

    public function removeAAndERecord(AAndERecord $aAndERecord): self
    {
        if ($this->aAndERecords->contains($aAndERecord)) {
            $this->aAndERecords->removeElement($aAndERecord);
            // set the owning side to null (unless already changed)
            if ($aAndERecord->getStaffId() === $this) {
                $aAndERecord->setStaffId(null);
            }
        }

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
            $appointment->setStaffId($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->contains($appointment)) {
            $this->appointments->removeElement($appointment);
            // set the owning side to null (unless already changed)
            if ($appointment->getStaffId() === $this) {
                $appointment->setStaffId(null);
            }
        }

        return $this;
    }
}
