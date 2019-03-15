<?php

namespace App\Entity;

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
}
