<?php

namespace App\Http\Controllers;

use App\Filters\Filter;
use App\Http\Requests\File\IndexFileRequest;
use App\Models\File;
use App\Http\Requests\File\StoreFileRequest;
use App\Utils\FilterRequestUtil;
use App\Utils\OrderByUtil;
use App\Utils\QueryString;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileController extends Controller
{
    private static function getWhere()
    {
        $where = [];

        // if (auth()?->user()?->role !== 'admin') {
        //     $where[] = ['user_id', '=', auth()?->id()];
        // }

        return $where;
    }
 
    public function index(IndexFileRequest $request)
    {
        return new JsonResponse(
            Filter::all($request, new File, [], $this::getWhere())
        );
    }

    /**
     * Store
     * @OA\Post (
     *     path="/api/file",
     *     tags={"File"},
     *     security={{"bearer_token": {}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                      required={"file"},
     *                      @OA\Property(
     *                          property="file",
     *                          type="file",
     *                      ),
     *              )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  ref="#/components/schemas/FileSchema"
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Validation error",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="The file field is required."),
     *                  @OA\Property(property="errors", type="object",
     *                      @OA\Property(property="The", type="array", collectionFormat="multi",
     *                        @OA\Items(
     *                          type="string",
     *                          example="The The field is required.",
     *                          )
     *                      ),
     *                 ),
     *          )
     *      )
     * )
     */
    public function store(StoreFileRequest $request)
    {
        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();
        $random_name = 'upload/' . random_int(1000, 9999) . time() . '.' . $extension;

        $file->storeAs('public/' . $random_name);

        $data = File::create([
            'name' =>  $file->getClientOriginalName(),
            'path' => url('') . '/storage/' . $random_name,
            'type' => $file->getClientMimeType(),
            'user_id' => auth()->id(),
        ]);

        return new JsonResponse([
            'data' => $data
        ], 201);
    }


    /**
     * Show
     * @OA\get (
     *     path="/api/file/{id}",
     *     tags={"File"},
     *     @OA\Parameter( 
     *          name="id",
     *          description="Id",
     *          in="path",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="number"
     *          ),
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  ref="#/components/schemas/FileSchema"
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Validation error",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Not found"),
     *                  ),
     *          )
     *      )
     * )
     */
    public function show(Request $request, int $id)
    {
        return new JsonResponse([
            'data' => Filter::one($request, new File, $id, $this::getWhere())
        ]);
    }

    /**
     * Delete
     * @OA\Delete (
     *     path="/api/file/{id}",
     *     tags={"File"},
     *     security={{"bearer_token": {}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="File id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Deleted"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Access error",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="No access"),
     *                 ),
     *          )
     *      )
     * )
     */
    public function destroy(int $id)
    {
        $file = File::findOrFail($id);

        if (auth()->check() && auth()?->user()?->cannot('delete', $file)) return new JsonResponse([
            'message' => 'No access'
        ], 403);

        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }
}
