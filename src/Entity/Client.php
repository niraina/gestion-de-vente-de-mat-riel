<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomCli;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $prenomCli;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $addresseCli;

    /**
     * @ORM\ManyToOne(targetEntity=Materiel::class, inversedBy="clients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $materiel;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteAchete;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="date")
     */
    private $dateAchat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typePaiement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $avance;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDecheance;

    /**
     * @ORM\PrePersist
    */
    public function Prepersist()
    {   
        if(empty($this->dateAchat)){
            $this->dateAchat = new \DateTime();
        }
    }

    public function __toString(){
        return $this->dateAchat;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName()
    {
       return "{$this->getNomCli()} {$this->getPrenomCli()}";
    }

    public function getNomCli(): ?string
    {
        return $this->nomCli;
    }

    public function setNomCli(string $nomCli): self
    {
        $this->nomCli = $nomCli;

        return $this;
    }

    public function getPrenomCli(): ?string
    {
        return $this->prenomCli;
    }

    public function setPrenomCli(string $prenomCli): self
    {
        $this->prenomCli = $prenomCli;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getAddresseCli(): ?string
    {
        return $this->addresseCli;
    }

    public function setAddresseCli(string $addresseCli): self
    {
        $this->addresseCli = $addresseCli;

        return $this;
    }

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): self
    {
        $this->materiel = $materiel;

        return $this;
    }

    public function getQteAchete(): ?int
    {
        return $this->qteAchete;
    }

    public function setQteAchete(int $qteAchete): self
    {
        $this->qteAchete = $qteAchete;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getTypePaiement(): ?string
    {
        return $this->typePaiement;
    }

    public function setTypePaiement(string $typePaiement): self
    {
        $this->typePaiement = $typePaiement;

        return $this;
    }

    public function getAvance(): ?int
    {
        return $this->avance;
    }

    public function setAvance(?int $avance): self
    {
        $this->avance = $avance;

        return $this;
    }

    public function getDateDecheance(): ?\DateTimeInterface
    {
        return $this->dateDecheance;
    }

    public function setDateDecheance(?\DateTimeInterface $dateDecheance): self
    {
        $this->dateDecheance = $dateDecheance;

        return $this;
    }
}
