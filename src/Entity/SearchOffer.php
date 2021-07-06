<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class SearchOffer
{
    private ?string $title = '';

    private ?Category $category = null;

    private ?float $minPrice = null;
    private ?float $maxPrice = null;

    private ?string $sortByPrice = null;

    /**
     * Get the value of title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * Set the value of category
     * @return self
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get the value of minPrice
     */
    public function getMinPrice(): ?float
    {
        return $this->minPrice;
    }

    /**
     * Set the value of minPrice
     */
    public function setMinPrice(?float $minPrice): self
    {
        $this->minPrice = $minPrice;
        return $this;
    }

    /**
     * Get the value of maxPrice
     */
    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     */
    public function setMaxPrice(?float $maxPrice): self
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * Get the value of sortByPrice
     */
    public function getSortByPrice(): ?string
    {
        return $this->sortByPrice;
    }

    /**
     * Set the value of sortByPrice
     */
    public function setSortByPrice(?string $sortByPrice): self
    {
        $this->sortByPrice = $sortByPrice;
        return $this;
    }
}
