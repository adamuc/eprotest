<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $confirmationcode;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registrationtime;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserInfo", mappedBy="user", cascade={"persist", "remove"})
     */
    private $userInfo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Protest", mappedBy="author")
     */
    private $protests;

    public function __construct()
    {
        $this->protests = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getConfirmationcode(): ?string
    {
        return $this->confirmationcode;
    }

    public function setConfirmationcode(?string $confirmationcode): self
    {
        $this->confirmationcode = $confirmationcode;

        return $this;
    }

    public function getRegistrationtime(): ?\DateTimeInterface
    {
        return $this->registrationtime;
    }

    public function setRegistrationtime(\DateTimeInterface $registrationtime): self
    {
        $this->registrationtime = $registrationtime;

        return $this;
    }

    public function getUserInfo(): ?UserInfo
    {
        return $this->userInfo;
    }

    public function setUserInfo(UserInfo $userInfo): self
    {
        $this->userInfo = $userInfo;

        // set the owning side of the relation if necessary
        if ($this !== $userInfo->getUser()) {
            $userInfo->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Protest[]
     */
    public function getProtests(): Collection
    {
        return $this->protests;
    }

    public function addProtest(Protest $protest): self
    {
        if (!$this->protests->contains($protest)) {
            $this->protests[] = $protest;
            $protest->setAuthor($this);
        }

        return $this;
    }

    public function removeProtest(Protest $protest): self
    {
        if ($this->protests->contains($protest)) {
            $this->protests->removeElement($protest);
            // set the owning side to null (unless already changed)
            if ($protest->getAuthor() === $this) {
                $protest->setAuthor(null);
            }
        }

        return $this;
    }
}
