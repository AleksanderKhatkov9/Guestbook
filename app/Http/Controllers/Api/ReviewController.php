<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Response;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $reviews = Review::with('responses')->paginate($perPage);

        return response()->json($reviews, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Review added successfully'], 201);
    }
}
