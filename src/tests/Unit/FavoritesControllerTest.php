<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Favorites;
use App\Models\Movie;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    public function testGetFavorites()
    {
        // 新しいユーザーを作成する
        $user = User::factory()->create();

        // ユーザーのお気に入りのムービーを 2 つ作成
        $favorites = Favorites::factory()->count(2)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/api/favorites');

        // ステータスコードをチェックしてデータ型を返す
        $response->assertStatus(200)->assertJsonCount(2);

        // お気に入りの映画リストが正しい情報を返したかどうかを確認
        $response->assertJson([
            [
                'user_id' => $user->id,
                'movie_id' => $favorites[0]->movie_id,
            ],
            [
                'user_id' => $user->id,
                'movie_id' => $favorites[1]->movie_id,
            ],
        ]);
    }

    public function testAddFavorite()
    {
        // ユーザーを作成してログイン
        $user = User::factory()->create();
        $this->actingAs($user);

        // お気に入りに追加するムービーを作成します
        $movie = Movie::factory()->create();

        $response = $this->postJson("/api/favorites/{$movie->id}");

        // レスポンスのステータスコードを確認する
        $response->assertStatus(200);

        // ムービーがユーザーのお気に入りリストに追加されているかどうかを確認します
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'movie_id' => $movie->id,
        ]);
    }
}
