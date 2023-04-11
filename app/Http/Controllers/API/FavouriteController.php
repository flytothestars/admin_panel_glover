<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
/**
    * @OA\Get(
    *       path="/favourites",
    *       tags={"Auth API"},
    *       summary="Favourites",
    *       @OA\Response(response="200", description="Successful"),
    *       @OA\Response(response="404", description="Not found"),
    *       security={
    *           {"sanctum": {}}
    *       },
    * )
    */
    public function index(Request $request){
        $favourites = Favourite::with('product.options')->where('user_id', "=", Auth::id())->get();
        return $favourites;
    }
/**
    * @OA\Post(path="/favourites", tags={"Auth API"},
    *   summary="Store favourites",
    *   @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="product_id",
     *                          type="string"
     *                      ),
     *                 ),
     *                 example={
     *                     "product_id":"",
     *                }
     *             )
     *         )
     *      ),
    *   @OA\Response(
    *     response=200,
    *     description="OK",
    *   ),
    *   @OA\Response(response=422, description="The provided credentials are incorrect."),
    *   security={
    *           {"sanctum": {}}
    *       },
    * )
    */
    public function store(Request $request){

        
        try{

            $model = Favourite::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
            if( !empty($model) ){
                return response()->json([
                    "message" => __("Product already Favourite")
                ], 400);
            }

            $model = new Favourite();
            $model->user_id = Auth::id();
            $model->product_id = $request->product_id;
            $model->save();

            return response()->json([
                "message" => __("Favourite added successfully")
            ], 200);

        }catch(\Exception $ex){

            return response()->json([
                "message" => __("No Favourite Found")
            ], 400);

        }

    }

    public function destroy(Request $request, $id){

        try{

            Favourite::where('user_id', "=", Auth::id())->where('product_id', "=", $id)->firstorfail()->delete();
            return response()->json([
                "message" => __("Favourite deleted successfully")
            ], 200);

        }catch(\Exception $ex){
            return response()->json([
                "message" => __("No Favourite Found")
            ], 400);
        }
    }

}