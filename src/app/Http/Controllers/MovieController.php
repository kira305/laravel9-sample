<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Movie::query();
        $query->select(['title']);
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        $movies = $query->get();

        return response()->json($movies);
    }
    /**
     * return that specific movie in detail
     */
    public function show($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }

        return response()->json($movie);
    }
}
