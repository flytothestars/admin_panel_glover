<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Onboarding;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{

    /**
     * @OA\Get(
     *     path="/app/onboarding",
     *      tags={"General"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not found")
     * )
     */
    public function index(Request $request)
    {

        $onboarding = Onboarding::when($request->type, function ($q) use ($request) {
            return $q->orWhere('type', $request->type);
        })->active()->get();
        return response()->json($onboarding, 200);
    }
}