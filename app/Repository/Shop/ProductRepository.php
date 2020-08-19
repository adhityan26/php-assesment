<?php

namespace App\Repository\Shop;

use App\Model\Shop\Product;
use Exception;
use Illuminate\Support\Facades\Cache;

/**
 * Class ProductRepository
 * @package App\Repository\Shop
 */
class ProductRepository {

    /**
     * @var array|mixed
     */
    public array $products;

    /**
     * ProductRepository constructor.
     */
    function __construct() {
        $this->products = Cache::get('products') ?? [];
    }

    /**
     * Put product into cache storage
     */
    private function saveProducts() {
        Cache::forever('products', $this->products);
    }

    /**
     * Clear product from cache storage
     */
    public function clearProduct() {
        Cache::forget('products');
    }

    /**
     * Get product index by it's id
     *
     * @param int $id
     * @return bool|false|int|string
     */
    public function getProductIndexById(int $id) {
        $this->products = Cache::get('products') ?? [];
        if ($this->products === null) {
            return false;
        }
        return array_search($id, array_column($this->products, 'id'));
    }

    /**
     * Create new product
     *
     * @param Product $product
     * @return Product
     * @throws Exception
     */
    public function addProduct(Product $product) {
        $index = $this->getProductIndexById($product->id);
        if ($index > -1) {
            throw new Exception('Product id ' . $product->id . ' already exists');
        }

        $this->products[] = $product;
        $this->saveProducts();
        return $product;
    }

    /**
     * Reduce product quantity based on id and quantity
     *
     * @param int $id
     * @param int $qty
     * @return Product
     * @throws Exception
     */
    public function reduceProductQty(int $id, int $qty) {
        $index = $this->getProductIndexById($id);
        if ($index === false) {
            throw new Exception('Product id ' . $id . ' is not found.');
        }
        if ($this->products[$index]->qty < 1) {
            throw new Exception('Product is out of stock.');
        }

        $oldQty = $this->products[$index]->qty;
        $this->products[$index]->qty -= $qty;
        if ($this->products[$index]->qty < 0) {
            throw new Exception('Not enough quantity left, only ' . $oldQty . ' quantity left.' );
        }

        $this->saveProducts();
        return $this->products[$index];
    }
}
