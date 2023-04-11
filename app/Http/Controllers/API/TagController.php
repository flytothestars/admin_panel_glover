<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{

    /**
    * @OA\Get(
    *       path="/tags",
    *       tags={"General"},
    *       summary="Get tags",
    *       @OA\Parameter (name="page", in="query", description="The page number", required=false, @OA\Schema(type="integer")),
    *       @OA\Response(response="200", description="Successful"),
    *       @OA\Response(response="404", description="Not found")
    * )
    */
    public function index(Request $request)
    {
        return Tag::when($request->page, function ($query) {
            return $query->paginate();
        }, function ($query) {
            return $query->get();
        });
       
    }
}