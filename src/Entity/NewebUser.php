<?php

namespace App\Entity;

use App\Repository\NewebUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewebUserRepository::class)]
class NewebUser extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $newebUserField;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $region;

    #[ORM\OneToMany(mappedBy: 'newebUser', targetEntity: ClientUser::class)]
    private $clientSigne;

    public function __construct()
    {
        $this->clientSigne = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection<int, ClientUser>
     */
    public function getClientSigne(): Collection
    {
        return $this->clientSigne;
    }

    public function addClientSigne(ClientUser $clientSigne): self
    {
        if (!$this->clientSigne->contains($clientSigne)) {
            $this->clientSigne[] = $clientSigne;
            $clientSigne->setNewebUser($this);
        }

        return $this;
    }

    public function removeClientSigne(ClientUser $clientSigne): self
    {
        if ($this->clientSigne->removeElement($clientSigne)) {
            // set the owning side to null (unless already changed)
            if ($clientSigne->getNewebUser() === $this) {
                $clientSigne->setNewebUser(null);
            }
        }

        return $this;
    }
}
