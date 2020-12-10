<?php

namespace App\Entity;

use App\Repository\ProductTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductTemplateRepository::class)
 */
class ProductTemplate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $winbiz_main_code;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="winbiz_main_code", orphanRemoval=true)
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWinbizMainCode(): ?int
    {
        return $this->winbiz_main_code;
    }

    public function setWinbizMainCode(int $winbiz_main_code): self
    {
        $this->winbiz_main_code = $winbiz_main_code;

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
            $product->setWinbizMainCode($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getWinbizMainCode() === $this) {
                $product->setWinbizMainCode(null);
            }
        }

        return $this;
    }
}
