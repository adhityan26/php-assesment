<?php

namespace App\Http\Controllers;

/**
 * @OA\GET(
 *     path="/",
 *     tags={"main"},
 *     summary="Version",
 *     description="View this application version.",
 *     @OA\Response(
 *         response="default",
 *         description="200"
 *     )
 * )
 *
 * @OA\GET(
 *     path="/flush",
 *     tags={"main"},
 *     summary="Clear Cache",
 *     description="Clear cache storage, hit this endpoint if some of the api can't be accessed",
 *     @OA\Response(
 *         response="default",
 *         description="200"
 *     )
 * )
 */
class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}
}
