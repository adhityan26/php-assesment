<?php

namespace App\Model\Shop;

/**
 * Class Product
 * @package App\Model\Shop
 */
class Product {
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $sku;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var float
     */
    public float $price;

    /**
     * @var int
     */
    public int $qty;

    /**
     * Product constructor.
     * @param int $id
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param int $qty
     */
    public function __construct(int $id, string $sku, string $name, float $price, int $qty) {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->qty = $qty;
    }

}
