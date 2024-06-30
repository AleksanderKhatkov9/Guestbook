<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Response;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function store(Request $request, $reviewId)
    {
        $request->validate([
            'response' => 'required|string',
        ]);

        $review = Review::findOrFail($reviewId);

        $response = Response::create([
            'review_id' => $review->id,
            'user_id' => Auth::id(),
            'response' => $request->response,
        ]);

        return response()->json(['message' => 'Response added successfully'], 201);
    }

}
