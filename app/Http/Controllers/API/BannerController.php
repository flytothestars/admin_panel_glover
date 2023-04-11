<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;


class BannerController extends Controller
{

    /**
    * @OA\Get(
    *       path="/banners",
    *       tags={"General"},
    *       summary="Banners",
    *       @OA\Response(response="200", description="Successful"),
    *       @OA\Response(response="404", description="Not found")
    * )
    */
    public function index(Request $request)
    {
        return BannerResource::collection(
            Banner::active()->inorder()
                ->when(
                    $request->vendor_type_id,
                    function ($query) use ($request) {
                        return $query->whereHas('category', function ($query) use ($request) {
                            return $query->active()->where('vendor_type_id', $request->vendor_type_id);
                        })->orWhereHas('vendor', function ($query) use ($request) {
                            return $query->active()->where('vendor_type_id', $request->vendor_type_id);
                        });
                    }
                )->when(
                    $request->featured,
                    function ($query) {
                        return $query->where('featured','1');
                    }
                )->get()
        );
    }
}