<?php

namespace App\Http\Controllers;

/**
 * @OA\GET(
 *     path="/",
 *     tags={"version"},
 *     summary="Version",
 *     description="View this application version.",
 *     @OA\Response(
 *         response="default",
 *         description="successful operation"
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
    public function __construct()
    {
        //
    }

    //
}
