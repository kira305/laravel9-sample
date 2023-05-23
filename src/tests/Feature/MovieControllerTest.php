<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Movie;

class MovieControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test GET /movies?search={search} endpoint.
     *
     * @return void
     */
    public function testGetMovies()
    {
        // 「movies」テーブルにサンプルデータを作成
        Movie::factory()->create(['title' => 'Avengers']);
        Movie::factory()->create(['title' => 'Spider-Man']);
        Movie::factory()->create(['title' => 'Iron Man']);

        $response = $this->get('/api/movies?search=Avengers');

        // ステータスコードをチェックしてデータ型を返す
        $response->assertStatus(200)
                 ->assertJsonCount(1)
                 ->assertJson([
                        ['title' => 'Avengers']
                 ]);
    }


    /**
     * Test GET /movies/:id endpoint.
     *
     * @return void
     */
    public function testGetMovieById()
    {
        // テスト用の映画をデータベースに作成する
        $movie = Movie::factory()->create();

        // GET /movies/{id} に対してリクエストを送信する
        $response = $this->get('/api/movies/' . $movie->id);

        // ステータスコードとレスポンスのJSON構造を検証する
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'title',
            'release_date',
            'genre'
        ]);
    }
}
