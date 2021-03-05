<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SousTypeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SousTypeRepository::class)
 * @ApiResource(
 *  formats={"json"},
 *  normalizationContext = {"groups"={"sousType_read"}},
 *  collectionOperations={"GET"},
 *  itemOperations={"GET"}
 * )
 */
class SousType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"sousType_read","materiel_read","categorie_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     * @Groups({"sousType_read","materiel_read","categorie_read"})
     */
    private $descrSousType;

    /**
     * @ORM\OneToMany(targetEntity=Categorie::class, mappedBy="sousType")
     * @Groups({"sousType_read"})
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescrSousType(): ?string
    {
        return $this->descrSousType;
    }

    public function setDescrSousType(string $descrSousType): self
    {
        $this->descrSousType = $descrSousType;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setSousType($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getSousType() === $this) {
                $category->setSousType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->descrSousType;
    }
}
