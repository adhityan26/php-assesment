<?php

namespace App\Http\Controllers\Tennis;

use App\Http\Controllers\Controller;
use App\Repository\Tennis\ContainerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

/**
 * Class ContainerController
 * @package App\Http\Controllers\Tennis
 */
class ContainerController extends Controller
{
    /**
     * View container content
     *
     * @return JsonResponse
     *
     * @OA\GET(
     *     path="/tennis",
     *     tags={"tennis"},
     *     summary="Container",
     *     description="Rahman view the container he is carrying.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     )
     * )
     */
    public function index() {
        $containerRepository = new ContainerRepository();
        return response()->json($containerRepository->container);
    }

    /**
     * Tennis carry the container into the war
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @OA\POST(
     *     path="/tennis/initContainer",
     *     tags={"tennis"},
     *     summary="Container Initialization",
     *     description="Initialize container that Rahman bring.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     ),
     *     @OA\RequestBody(
     *         description="initialize value for the container",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="containerNumber",
     *                 type="integer",
     *                 example=5
     *             ),
     *             @OA\Property(
     *                 property="containerSize",
     *                 type="integer",
     *                 example=10
     *             )
     *         )
     *     )
     * )
     * @throws Exception
     */
    public function initContainer(Request $request) {
        $containerRepository = new ContainerRepository();
        $param = $request->all();
        $containers = $containerRepository->initContainers($param['containerNumber'], $param['containerSize']);
        return response()->json($containers);
    }

    /**
     * Put ball randomly into container
     *
     * @OA\PUT(
     *     path="/tennis/putBall",
     *     tags={"tennis"},
     *     summary="Put Ball",
     *     description="Rahman put a ball randomly into a container.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     )
     * )
     * @return JsonResponse
     */
    public function putBall()
    {
        try {
            $containerRepository = new ContainerRepository();
            $size = count($containerRepository->container);
            $index = rand(0, $size - 1);

            $containerRepository->verifiedContainer();

            $container = $containerRepository->putBall($index);
            return response()->json([
                'index' => $index,
                'container' => $container
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Clear all container from ball
     *
     * @return JsonResponse
     *
     * @OA\DELETE(
     *     path="/tennis/clearContainer",
     *     tags={"tennis"},
     *     summary="Clear Container",
     *     description="Rahman removing ball from all of the container.",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation"
     *     )
     * )
     * @throws Exception
     */
    public function clearContainer() {
        $containerRepository = new ContainerRepository();
        return response()->json($containerRepository->initContainers());
    }
}
