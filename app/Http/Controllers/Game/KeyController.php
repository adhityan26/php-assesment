<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Model\Game\Ground;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class KeyController
 * @package App\Http\Controllers\Game
 */
class KeyController extends Controller {

    /**
     * Create new product
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @OA\POST(
     *     path="/game/key",
     *     tags={"game"},
     *     summary="Hide and seek",
     *     description="Joni felling excited to find his key.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     ),
     *     @OA\RequestBody(
     *         description="Joni's house and his starting point",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="maps",
     *                 type="array",
     *                 example={{"#", "#", "#", "#", "#", "#", "#", "#"},{"#", ".", ".", ".", ".", ".", ".", "#"},{"#", ".", "#", "#", "#", ".", ".", "#"},{"#", ".", ".", ".", "#", ".", "#", "#"},{"#", ".", "#", ".", ".", ".", ".", "#"},{"#", "#", "#", "#", "#", "#", "#", "#"}},
     *                 @OA\Items(
     *                     type="array",
     *                     @OA\Items(
     *                         type="string"
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="startPoint",
     *                 type="object",
     *                 @OA\Property(
     *                    property="x",
     *                    type="integer",
     *                    example="1"
     *                 ),
     *                 @OA\Property(
     *                    property="y",
     *                    type="integer",
     *                    example="4"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    public function findingKey(Request $request) {
        $joni = new Ground($request->input('startPoint.x'), $request->input('startPoint.y'), $request->input('maps'));
        $history = [];
        $joni->forward('n', false, $history);
        return response()->json(array_unique($joni->possibleKeyLocation));
    }
}
