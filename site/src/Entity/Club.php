<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteDeCompet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reseauxSocial;

    /**
     * @ORM\OneToOne(targetEntity=ClubPictureUpload::class, cascade={"persist", "remove"})
     */
    private $clubPicture;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="club", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $manager;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFondationClub;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSiteDeCompet(): ?string
    {
        return $this->siteDeCompet;
    }

    public function setSiteDeCompet(?string $siteDeCompet): self
    {
        $this->siteDeCompet = $siteDeCompet;

        return $this;
    }

    public function getReseauxSocial(): ?string
    {
        return $this->reseauxSocial;
    }

    public function setReseauxSocial(?string $reseauxSocial): self
    {
        $this->reseauxSocial = $reseauxSocial;

        return $this;
    }

    public function getClubPicture(): ?ClubPictureUpload
    {
        return $this->clubPicture;
    }

    public function setClubPicture(?ClubPictureUpload $clubPicture): self
    {
        $this->clubPicture = $clubPicture;

        return $this;
    }

    public function getManager(): ?User
    {
        return $this->manager;
    }

    public function setManager(User $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    public function getDateFondationClub(): ?\DateTimeInterface
    {
        return $this->dateFondationClub;
    }

    public function setDateFondationClub(?\DateTimeInterface $dateFondationClub): self
    {
        $this->dateFondationClub = $dateFondationClub;

        return $this;
    }
}
