<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Favorites;
use Facades\App\Repositories\{
    MovieFavorite as MovieFavoriteRepository
};
use Mockery as M;
use App\Services\MovieFavorite as MovieFavoriteService;
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

        MovieFavoriteRepository::shouldReceive('addFavorite')
        ->with($userId, $movieId)
        ->once()
        ->andReturn(M::mock(Favorites::class));

        $actual = (new MovieFavoriteService)->addFavorite($userId, $movieId);
        $this->assertInstanceOf(Favorites::class, $actual, '->addFavorite() Favoriteモデルが返却される');

    }
}
