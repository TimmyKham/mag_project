<?php
namespace App\Entity;

class MagazinesSearch {

    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return MagazinesSearch
     */
    public function setMaxPrice(int $maxPrice): MagazinesSearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

}