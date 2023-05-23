<?php

namespace App\Services;

use App\Contracts\Services\MovieFavorite as MovieFavoriteContract;
use Facades\App\Contracts\Repositories\{
    MovieFavorite as MovieFavoriteRepository
};
use App\Models\Favorites;

/**
 * 商品機能サービス
 */
class MovieFavorite implements MovieFavoriteContract
{
    public function addFavorite($userId, $movieId): Favorites
    {
        return MovieFavoriteRepository::addFavorite($userId, $movieId);
    }
}
