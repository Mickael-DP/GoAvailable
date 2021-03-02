<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $psn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gamertag;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $origin;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $pseudo;

    /**
     * @ORM\OneToOne(targetEntity=ProfilPictureUpload::class, cascade={"persist", "remove"})
     */
    private $profilPicture;

    /**
     * @ORM\OneToOne(targetEntity=Club::class, mappedBy="manager", cascade={"persist", "remove"})
     */
    private $club;

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPsn(): ?string
    {
        return $this->psn;
    }

    public function setPsn(?string $psn): self
    {
        $this->psn = $psn;

        return $this;
    }

    public function getGamertag(): ?string
    {
        return $this->gamertag;
    }

    public function setGamertag(?string $gamertag): self
    {
        $this->gamertag = $gamertag;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(?string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getProfilPicture(): ?ProfilPictureUpload
    {
        return $this->profilPicture;
    }

    public function setProfilPicture(?ProfilPictureUpload $profilPicture): self
    {
        $this->profilPicture = $profilPicture;

        return $this;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {

        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
        ));
    }

    /** @see \Serializable::serialize() */
    public function unserialize($serialized)
    {

        list(
            $this->id,
            $this->email,
            $this->password,
        ) = unserialize($serialized);
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(Club $club): self
    {
        // set the owning side of the relation if necessary
        if ($club->getManager() !== $this) {
            $club->setManager($this);
        }

        $this->club = $club;

        return $this;
    }
}
