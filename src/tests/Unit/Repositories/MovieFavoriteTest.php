<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Repositories\MovieFavorite;
use App\Models\Favorites;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * 商品機能サービス
 */
class MovieFavoriteTest extends TestCase
{
    use RefreshDatabase;

    public function testAddFavorite(): void
    {
        $userId = 10;
        $movieId = 100;

        $actual = (new MovieFavorite())->addFavorite($userId, $movieId);

        $this->assertInstanceOf(Favorites::class, $actual, '->addFavorite(param) 登録されたモデルが返る');
        $this->assertSame($userId, $actual->user_id, '->addFavorite(param) 引数で渡した商品名が設定されている');
        $this->assertSame($movieId, $actual->movie_id, '->addFavorite(param) 引数で渡した商品名が設定されている');
        $this->assertDatabaseHas('favorites', [
            'user_id' => $userId,
            'movie_id' => $movieId,
        ]);
    }
}
