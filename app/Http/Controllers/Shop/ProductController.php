<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Model\Shop\Product;
use App\Repository\Shop\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

/**
 * Class ProductController
 * @package App\Http\Controllers\Shop
 */
class ProductController extends Controller {

    /**
     * View magazine content
     *
     * @return JsonResponse
     *
     * @OA\GET(
     *     path="/shop",
     *     tags={"shop"},
     *     summary="Product",
     *     description="Display Kitara shop products.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     )
     * )
     */
    public function index() {
        $productRepository = new ProductRepository();
        return response()->json($productRepository->products);
    }

    /**
     * Create new product
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @OA\POST(
     *     path="/shop/addProduct",
     *     tags={"shop"},
     *     summary="Product",
     *     description="Display Kitara shop products.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     ),
     *     @OA\RequestBody(
     *         description="create new product for Kitara shop",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="sku",
     *                 type="string",
     *                 example="SKU00001"
     *             ),
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 example="Product A"
     *             ),
     *             @OA\Property(
     *                 property="price",
     *                 type="decimal",
     *                 example=100000
     *             ),
     *             @OA\Property(
     *                 property="qty",
     *                 type="integer",
     *                 example=100
     *             )
     *         )
     *     )
     * )
     */
    public function addProduct(Request $request) {
        $productRepository = new ProductRepository();
        $param = $request->all();
        $product = new Product($param['id'], $param['sku'], $param['name'], $param['price'], $param['qty']);
        try {
            return response()->json($productRepository->addProduct($product));
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Clear all product
     *
     * @return JsonResponse
     *
     * @OA\DELETE(
     *     path="/soldier/clearProduct",
     *     tags={"shop"},
     *     summary="Clear Products",
     *     description="Remove all product from Kitara Shop.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     )
     * )
     */
    public function clearProduct() {
        $productRepository = new ProductRepository();
        $productRepository->clearProduct();
        return response()->json([
            "message" => "Product is cleared."
        ]);
    }

    /**
     * Reduce product quantity
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @OA\PUT(
     *     path="/shop/reduceQty",
     *     tags={"shop"},
     *     summary="Reduce Product Quantity",
     *     description="Someone bought a product from Kitara Shop.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     ),
     *     @OA\RequestBody(
     *         description="create new product for Kitara shop",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="qty",
     *                 type="integer",
     *                 example=5
     *             )
     *         )
     *     )
     * )
     */
    public function reduceQty(Request $request) {
        $productRepository = new ProductRepository();
        $param = $request->all();
        try {
            return response()->json($productRepository->reduceProductQty($param['id'], $param['qty']));
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
