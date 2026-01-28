<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $society_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $activity_type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contact_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poste = null;

    #[ORM\Column(length: 20, nullable: true)]  // ✅ Changez de int à string
    private ?string $contact_phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contact_email = null;

    #[ORM\OneToOne(inversedBy: 'client', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSocietyName(): ?string
    {
        return $this->society_name;
    }

    public function setSocietyName(?string $society_name): static
    {
        $this->society_name = $society_name;

        return $this;
    }

    public function getActivityType(): ?string
    {
        return $this->activity_type;
    }

    public function setActivityType(?string $activity_type): static
    {
        $this->activity_type = $activity_type;

        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->contact_name;
    }

    public function setContactName(?string $contact_name): static
    {
        $this->contact_name = $contact_name;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(?string $poste): static
    {
        $this->poste = $poste;

        return $this;
    }

     public function getContactPhone(): ?string
    {
        return $this->contact_phone;
    }

    public function setContactPhone(?string $contact_phone): static
    {
        $this->contact_phone = $contact_phone;
        return $this;
    }


    public function getContactEmail(): ?string
    {
        return $this->contact_email;
    }

    public function setContactEmail(?string $contact_email): static
    {
        $this->contact_email = $contact_email;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(Users $users): static
    {
        $this->users = $users;

        return $this;
    }
}
