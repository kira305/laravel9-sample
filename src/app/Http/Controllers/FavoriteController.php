<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorites;
use App\Models\Movie;
use Facades\App\Contracts\Services\{
    MovieFavorite as MovieFavoriteService
};

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        // ユーザーのお気に入りの映画リストを取得します
        $favorites = Favorites::where('user_id', $userId)
            ->with('movie')
            ->get();

        // お気に入りの映画のリストを返します
        return response()->json($favorites);
    }

    // コントローラにお気に入り映画を追加するためのメソッド
    public function addFavorite($id)
    {
        // 映画が存在するかどうかを確認する
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => '映画が見つかりません'], 404);
        }

        // 既にお気に入りに登録されているかどうかを確認する
        $favorite = Favorites::where('user_id', auth()->id())->where('movie_id', $id)->first();
        if ($favorite) {
            return response()->json(['message' => '既にお気に入りに登録されています'], 409);
        }

        $userId = auth()->id();

        // 映画をお気に入りに追加する
        $result = MovieFavoriteService::addFavorite($userId, $id);

        return response()->json(['message' => '映画がお気に入りに追加されました'], 200);
    }
}
