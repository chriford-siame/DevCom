<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="L5 Swagger API Documentation",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="support@example.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 */
/**
 * @OA\Get(
 *     path="/api/posts",
 *     operationId="getUsersList",
 *     tags={"Posts"},
 *     summary="Get list of posts",
 *     description="Returns list of posts",
 *     @OA\Response(
 *         response=200,
 *         description="successful operation",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Post"))
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request"
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
