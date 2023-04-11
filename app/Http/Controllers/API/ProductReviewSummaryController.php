<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductReviewSummaryController extends Controller
{
    /**
    * @OA\Get(
    *       path="/product/review/summary",
    *       tags={"General"},
    *       summary="Product summary",
    *       @OA\Parameter (name="id", in="query", description="Id product", required=true, @OA\Schema(type="integer")),
    *       @OA\Parameter (name="rating_summary", in="query", description="Rating", required=true, @OA\Schema(type="integer")),
    *       @OA\Response(response="200", description="Successful"),
    *       @OA\Response(response="404", description="Not found")
    * )
    */
    public function index(Request $request)
    {

        $product = Product::find($request->id);
        // $product->unsetRelation('vendor');
        $produuct['rating_summary'] = $product->rating_summary;

        return [
            "rating_summary" => $product->rating_summary,
            "latest_reviews" => ProductReview::with('user')->where("product_id",$product->id)->latest()->limit(rand(3,4))->get(),
        ];

    }

}