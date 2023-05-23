<?php

namespace App\Contracts\Repositories;

use App\Models\Favorites;

/**
 * 動画サービスインターフェース
 *
 */
interface MovieFavorite
{
    public function addFavorite($userId, $movieId): Favorites;
}
