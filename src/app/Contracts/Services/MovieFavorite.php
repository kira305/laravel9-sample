<?php

namespace App\Contracts\Services;

use App\Models\Favorites;

/**
 * 動画サービスインターフェース
 *
 */
interface MovieFavorite
{
    public function addFavorite($userId, $movieId): Favorites;
}
