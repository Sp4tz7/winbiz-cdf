<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $item_code;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $pictures;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creation_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modification_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $availability_date;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_fr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_de;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_it;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_en;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_fr;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_de;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_it;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_en;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     */
    private $category_id;

    /**
     * @ORM\ManyToOne(targetEntity=Manufacturer::class, inversedBy="products")
     */
    private $manufacturer;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $winbiz_id;

    /**
     * @ORM\ManyToOne(targetEntity=ProductTemplate::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $winbiz_main_code;

    public function __construct()
    {
        $this->category_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getItemCode(): ?string
    {
        return $this->item_code;
    }

    public function setItemCode(string $item_code): self
    {
        $this->item_code = $item_code;

        return $this;
    }

    public function getPictures(): ?string
    {
        return $this->pictures;
    }

    public function setPictures(?string $pictures): self
    {
        $this->pictures = $pictures;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getModificationDate(): ?\DateTimeInterface
    {
        return $this->modification_date;
    }

    public function setModificationDate(?\DateTimeInterface $modification_date): self
    {
        $this->modification_date = $modification_date;

        return $this;
    }

    public function getAvailabilityDate(): ?\DateTimeInterface
    {
        return $this->availability_date;
    }

    public function setAvailabilityDate(?\DateTimeInterface $availability_date): self
    {
        $this->availability_date = $availability_date;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNameFr(): ?string
    {
        return $this->name_fr;
    }

    public function setNameFr(string $name_fr): self
    {
        $this->name_fr = $name_fr;

        return $this;
    }

    public function getNameDe(): ?string
    {
        return $this->name_de;
    }

    public function setNameDe(?string $name_de): self
    {
        $this->name_de = $name_de;

        return $this;
    }

    public function getNameIt(): ?string
    {
        return $this->name_it;
    }

    public function setNameIt(?string $name_it): self
    {
        $this->name_it = $name_it;

        return $this;
    }

    public function getNameEn(): ?string
    {
        return $this->name_en;
    }

    public function setNameEn(?string $name_en): self
    {
        $this->name_en = $name_en;

        return $this;
    }

    public function getDescriptionFr(): ?string
    {
        return $this->description_fr;
    }

    public function setDescriptionFr(?string $description_fr): self
    {
        $this->description_fr = $description_fr;

        return $this;
    }

    public function getDescriptionDe(): ?string
    {
        return $this->description_de;
    }

    public function setDescriptionDe(?string $description_de): self
    {
        $this->description_de = $description_de;

        return $this;
    }

    public function getDescriptionIt(): ?string
    {
        return $this->description_it;
    }

    public function setDescriptionIt(?string $description_it): self
    {
        $this->description_it = $description_it;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->description_en;
    }

    public function setDescriptionEn(?string $description_en): self
    {
        $this->description_en = $description_en;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategoryId(): Collection
    {
        return $this->category_id;
    }

    public function addCategoryId(Category $categoryId): self
    {
        if (!$this->category_id->contains($categoryId)) {
            $this->category_id[] = $categoryId;
        }

        return $this;
    }

    public function removeCategoryId(Category $categoryId): self
    {
        $this->category_id->removeElement($categoryId);

        return $this;
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getWinbizId(): ?int
    {
        return $this->winbiz_id;
    }

    public function setWinbizId(int $winbiz_id): self
    {
        $this->winbiz_id = $winbiz_id;

        return $this;
    }

    public function getWinbizMainCode(): ?ProductTemplate
    {
        return $this->winbiz_main_code;
    }

    public function setWinbizMainCode(?ProductTemplate $winbiz_main_code): self
    {
        $this->winbiz_main_code = $winbiz_main_code;

        return $this;
    }

}
