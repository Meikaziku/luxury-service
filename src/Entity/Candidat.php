<?php

namespace App\Entity;

use App\Repository\CandidatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatRepository::class)]
class Candidat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationality = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $passport_file = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profil_picture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $current_location = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_of_birth = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $place_of_birth = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $short_description = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deleted_at = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    private ?JobCategory $job_category = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    private ?ExperienceCategory $experience = null;

    #[ORM\ManyToOne]
    private ?Gender $gender_type = null;

    #[ORM\OneToOne(inversedBy: 'candidat', cascade: ['persist', 'remove'])]
    private ?Users $users = null;


    public function getCompletionPercentage(): int
    {
        // Liste des champs obligatoires
        $fields = [
            $this->first_name,
            $this->last_name,
            $this->adress,
            $this->country,
            $this->nationality,
            $this->passport_file,
            $this->cv,
            $this->profil_picture,
            $this->current_location,
            $this->date_of_birth,
            $this->short_description,
            $this->job_category,
            $this->experience,
            $this->gender_type,
        ];

        $filled = 0;
        $total = count($fields);

        foreach ($fields as $value) {
            if (!empty($value)) {
                $filled++;
            }
        }

        return (int) round(($filled / $total) * 100);
    }
    
    public function isComplete(): bool
    {
        return
            $this->first_name &&
            $this->last_name &&
            $this->adress &&
            $this->country &&
            $this->nationality &&
            $this->passport_file &&
            $this->cv &&
            $this->profil_picture &&
            $this->current_location &&
            $this->date_of_birth &&
            $this->short_description &&
            $this->job_category &&
            $this->experience &&
            $this->gender_type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getPassportFile(): ?string
    {
        return $this->passport_file;
    }

    public function setPassportFile(?string $passport_file): static
    {
        $this->passport_file = $passport_file;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    public function getProfilPicture(): ?string
    {
        return $this->profil_picture;
    }

    public function setProfilPicture(?string $profil_picture): static
    {
        $this->profil_picture = $profil_picture;

        return $this;
    }

    public function getCurrentLocation(): ?string
    {
        return $this->current_location;
    }

    public function setCurrentLocation(?string $current_location): static
    {
        $this->current_location = $current_location;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTime
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(?\DateTime $date_of_birth): static
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->place_of_birth;
    }

    public function setPlaceOfBirth(?string $place_of_birth): static
    {
        $this->place_of_birth = $place_of_birth;

        return $this;
    }


    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(?string $short_description): static
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?\DateTimeImmutable $deleted_at): static
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    public function getJobCategory(): ?JobCategory
    {
        return $this->job_category;
    }

    public function setJobCategory(?JobCategory $job_category): static
    {
        $this->job_category = $job_category;

        return $this;
    }

    public function getExperience(): ?ExperienceCategory
    {
        return $this->experience;
    }

    public function setExperience(?ExperienceCategory $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getGenderType(): ?Gender
    {
        return $this->gender_type;
    }

    public function setGenderType(?Gender $gender_type): static
    {
        $this->gender_type = $gender_type;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }
}
