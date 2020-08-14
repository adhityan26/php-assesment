<?php

namespace App\Http\Controllers\Soldier;

use App\Http\Controllers\Controller;
use App\Repository\Soldier\MagazineRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

/**
 * Class MagazineController
 * @package App\Http\Controllers\Soldier
 */
class MagazineController extends Controller
{
    /**
     * View magazine content
     *
     * @return JsonResponse
     *
     * @OA\GET(
     *     path="/soldier",
     *     tags={"soldier"},
     *     summary="Magazine",
     *     description="Soldier view magazine the magazine he is carrying.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     )
     * )
     */
    public function index() {
        $magazineRepository = new MagazineRepository();
        return response()->json($magazineRepository->magazines);
    }

    /**
     * Soldier carry the magazine into the war
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @OA\POST(
     *     path="/soldier/initMagazine",
     *     tags={"soldier"},
     *     summary="Magazine Initialization",
     *     description="Initialize magazazine that the soldier carry to the war.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     ),
     *     @OA\RequestBody(
     *         description="initialize value for the magazine",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="magazineNumber",
     *                 type="integer",
     *                 example=5
     *             ),
     *             @OA\Property(
     *                 property="magazineSize",
     *                 type="integer",
     *                 example=10
     *             )
     *         )
     *     )
     * )
     */
    public function initMagazine(Request $request) {
        $magazineRepository = new MagazineRepository();
        $param = $request->all();
        $magazines = $magazineRepository->initMagazines($param['magazineNumber'], $param['magazineSize']);
        return response()->json($magazines);
    }

    /**
     * Put ammo randomly into magazine
     *
     * @OA\PUT(
     *     path="/soldier/putAmmo",
     *     tags={"soldier"},
     *     summary="Put Ammo",
     *     description="Soldier putting ammo into a magazone randomly.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     )
     * )
     * @return JsonResponse
     */
    public function putAmmo()
    {
        try {
            $magazineRepository = new MagazineRepository();
            $size = count($magazineRepository->magazines);
            $index = rand(0, $size - 1);

            $magazineRepository->verifiedMagazine();

            $magazine = $magazineRepository->putAmmo($index);
            return response()->json([
                'index' => $index,
                'magazine' => $magazine
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Clear all magazine from ammo
     *
     * @return JsonResponse
     *
     * @OA\DELETE(
     *     path="/soldier/clearMagazine",
     *     tags={"soldier"},
     *     summary="Clear Magazine",
     *     description="Soldier removing ammo from all of the magazine.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     )
     * )
     */
    public function clearMagazine() {
        $magazineRepository = new MagazineRepository();
        return response()->json($magazineRepository->initMagazines());
    }

    /**
     * Get verified magazine
     *
     * @return JsonResponse
     *
     * @OA\GET(
     *     path="/soldier/testMagazine",
     *     tags={"soldier"},
     *     summary="Test Magazine",
     *     description="Soldier test the verified magazine.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     )
     * )
     */
    public function testMagazine() {
        try {
            $magazineRepository = new MagazineRepository();
            $verifiedIndex = $magazineRepository->testMagazine();
            return response()->json([
                'index' => $verifiedIndex,
                'magazine' => $magazineRepository->magazines[$verifiedIndex]
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 422);
        }
    }
}
