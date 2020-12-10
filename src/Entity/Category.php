<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $sort_order;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
    private $picture;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $parent_id;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="category_id")
     */
    private $products;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $winbiz_id;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sort_order;
    }

    public function setSortOrder(?int $sort_order): self
    {
        $this->sort_order = $sort_order;

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

    public function setNameDe(string $name_de): self
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function setParentId(?int $parent_id): self
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addCategoryId($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeCategoryId($this);
        }

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
}
