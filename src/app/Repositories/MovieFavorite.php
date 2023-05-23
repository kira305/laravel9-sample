<?php

namespace App\Repositories;

use App\Contracts\Repositories\MovieFavorite as MovieFavoriteContract;
use App\Models\Favorites;

/**
 * 商品機能サービス
 */
class MovieFavorite implements MovieFavoriteContract
{
    public function addFavorite($userId, $movieId): Favorites
    {
        return Favorites::create([
            'user_id' => $userId,
            'movie_id' => $movieId,
        ]);
    }
}
