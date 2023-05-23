<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Movie::query();

        // Nếu có giá trị search, thực hiện tìm kiếm
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        // Lấy danh sách phim
        $movies = $query->get();

        return response()->json($movies);
    }
}
