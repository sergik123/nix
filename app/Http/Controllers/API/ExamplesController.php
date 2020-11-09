<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ExampleStoreRequest;
use App\Models\Books;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Request;

class ExamplesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/examples",
     *     operationId="examplesAll",
     *     tags={"Examples"},
     *     summary="Display a listing of the resource",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="The page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *      )
     * ),
     *
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if(isset($_GET['sort'])){
            $sort=$_GET['sort'];

        }else{
            $sort='id';
        }
        $data=Books::query()->orderBy($sort)->paginate(15);
        return response()->json($data);
    }

    /**
     * @OA\Post(
     *     path="/examples",
     *     operationId="exampleCreate",
     *     tags={"Examples"},
     *     summary="Create yet another example record",
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ExampleStoreRequest")
     *     ),
     * )
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExampleStoreRequest $request)
    {
        $item=new Books();
        $item->fill($request->all());
        $item->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Books::query()->findOrFail($id);
        return response()->json($model);
    }

    /**
     * @OA\Put(
     *     path="/examples/{id}",
     *     operationId="examplesUpdate",
     *     tags={"Examples"},
     *     summary="Update example by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of example",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ExampleStoreRequest")
     *     ),
     * )
     *
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(Request $request, $id)
    {
        $params = $request->all();
        $model  = Books::query()->findOrFail($id);
        $model->fill($params);
        $model->save();

        return response()->json($model);
    }

    /**
     * @OA\Delete(
     *     path="/examples/{id}",
     *     operationId="examplesDelete",
     *     tags={"Examples"},
     *     summary="Delete example by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of example",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="202",
     *         description="Deleted",
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $model = Books::query()->findOrFail($id);
        $model->delete();

        return response(null, HttpResponse::HTTP_ACCEPTED);
    }
}
