<?php

namespace App\Model\Shop;

class Product {
    public $id;
    public $sku;
    public $name;
    public $price;
    public $qty;

    /**
     * Product constructor.
     *
     * @param $id
     * @param $sku
     * @param $name
     * @param $price
     * @param $qty
     */
    public function __construct($id, $sku, $name, $price, $qty) {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->qty = $qty;
    }

}
