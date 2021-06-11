<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="date", nullable=true)

     */
    private $birthDay;

    /**
     * @ORM\OneToMany(targetEntity=UsersPhones::class, mappedBy="Users",
     *        orphanRemoval=true, cascade={"persist"})
     */
    private $usersPhones;

    public function __construct()
    {
        $this->usersPhones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }
/**
* @var DateTimeImmutable
 *
 */
    public function getBirthDay(): ?\DateTimeImmutable
    {
        return $this->birthDay;
    }

    public function setBirthDay(?\DateTimeImmutable $birthDay): self
    {
        $this->birthDay = $birthDay;

        return $this;
    }

    /**
     * @return Collection|UsersPhones[]
     */
    public function getUsersPhones(): Collection
    {
        return $this->usersPhones;
    }

    public function addUsersPhone(UsersPhones $usersPhone): self
    {
        if (!$this->usersPhones->contains($usersPhone)) {
            $this->usersPhones[] = $usersPhone;
            $usersPhone->setUsers($this);
        }

        return $this;
    }

    public function removeUsersPhone(UsersPhones $usersPhone): self
    {
        if ($this->usersPhones->removeElement($usersPhone)) {
            // set the owning side to null (unless already changed)
            if ($usersPhone->getUsers() === $this) {
                $usersPhone->setUsers(null);
            }
        }

        return $this;
    }
}
