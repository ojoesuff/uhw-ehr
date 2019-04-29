<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accountLocked;

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
