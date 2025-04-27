<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\BookDemand;
use App\Models\BookOffer;
use App\Models\Genre;
use App\Models\Publisher;
use App\Models\User;
use App\Models\Work;
use Database\Seeders\DictionariesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BooksTest extends TestCase
{
    /*public function test_all_offered_books(): void
    {
        $response = $this->get('/api/book-offers');

        $response->assertStatus(200);
    }

    public function test_book_offers_by_user(): void
    {
        $response = $this->get('/api/book-offers/1');
        
        $response->assertStatus(200);
    }

    public function test_all_book_demands_with_users(): void
    {
        $response = $this->get('/api/book-demands');

        $response->assertStatus(200);
    }

    public function test_author_all_works(): void
    {
        $response = $this->get('/api/authorworks/Willa Schoen');

        $response->assertStatus(200);
    }

    public function test_delete_demanded_book(): void
    {
        $response = $this->delete('/api/book-demand/4');

        $response->assertStatus(200);
    }

    public function test_most_exchanged_genre(): void
    {
        $response = $this->get('/api/most-exchanged-genre');

        $response->assertStatus(200);
    }
    
    public function test_most_exchanged_city(): void
    {
        $response = $this->get('/api/most-exchanged-city');

        $response->assertStatus(200);
    }

    public function test_book_quality_list(): void
    {
        $response = $this ->get('/api/book-quality-list');

        $response->assertStatus(200);

    }

    public function test_bad_quality_books(): void
    {
        $response = $this ->get('/api/bad-quality-books');

        $response->assertStatus(200);

    }
    
    public function test_all_available_books(): void
    {
        $response = $this ->get('/api/all-available-books');

        $response->assertStatus(200);

    }
    

    public function test_demand_flips_when_offer_created()
    {
        // Setup: genre, publisher, work, author, user
        $genre     = Genre::factory()->create();
        $publisher = Publisher::factory()->create();
        $work      = Work::factory()->create(['genre_id'=>$genre->genre_id]);
        $author    = Author::factory()->create();
        $work->authors()->attach($author->author_id);
        $user1     = User::factory()->create();
        $user2     = User::factory()->create();

        // 1) létrehozunk egy keresést
        $demand = BookDemand::factory()->create([
            'user'   => $user1->id,
            'publisher'         => $publisher->publisher_id,
            'work'            => $work->work_id,
            'language'         => 'hu',
            'min_publication_year' => 2010,
            'max_publication_year' => 2024,
            'demand_status' => 'k'
        ]);

        // Assert: kezdetben 'k'
        $this->assertDatabaseHas('book_demands', [
            'demand_id'     => $demand->demand_id,
            'demand_status'=> 'k'
        ]);

        // 2) feltöltünk egy kínálatot, ami illeszkedik
        BookOffer::factory()->create([
            'user'   => $user2->id,
            'publisher'         => $publisher->publisher_id,
            'work'            => $work->work_id,
            'language'         => 'hu',
            'publication_year'     => 2020,
            'quality'       => 5,
        ]);

        // Assert: a demand státusz változott
        $this->assertDatabaseHas('book_demands', [
            'demand_id'     => $demand->demand_id,
            'demand_status'=> 't'
        ]);
    }*/

    use RefreshDatabase;


    /** @var User */
    protected $user1;
    /** @var User */
    protected $user2;
    /** @var Publisher */
    protected $publisher;
    /** @var Author */
    protected $author;
    /** @var Work */
    protected $work;

    protected function setUp(): void
    {
        parent::setUp();

        // ----------------------------------------------------------------------------
        // Futtassuk le a dictionaries seedert, hogy a trigger tudjon érvényes értékeket találni
        $this->seed(DictionariesTableSeeder::class);
        // ----------------------------------------------------------------------------


        // 1) Két user
        $this->user1 = User::factory()->create();
        $this->user2 = User::factory()->create();

        // 2) Genre
        $genre = Genre::factory()->create();

        // 3) Publisher és Author
        $this->publisher = Publisher::factory()->create([
            'publisher_name' => 'Teszt Kiadó',
        ]);
        $this->author = Author::factory()->create([
            'author_name' => 'Kovács Péter',
        ]);

        // 4) Work, és pivotban kötés az author-ral
        $this->work = Work::factory()->create([
            'genre_id' => $genre->genre_id,
            'title'    => 'Teszt Könyv',
        ]);
        $this->work->authors()->attach($this->author->author_id);
    }

    public function test_book_offer_triggers_demand_matching()
    {
        // A) Létrehozunk egy keresést (pending)
        $demand = BookDemand::factory()->create([
            'user'                 => $this->user1->id,
            'publisher'            => $this->publisher->publisher_id,
            'work'                 => $this->work->work_id,
            'language'             => 'hu',
            'min_publication_year' => 2000,
            'max_publication_year' => 2025,
            //'demand_status'        => 'k',
        ]);

        // Ellenőrizzük, hogy tényleg 'k'-val indult
        $this->assertDatabaseHas('book_demands', [
            'demand_id'     => $demand->demand_id,
            'demand_status' => 'k',
        ]);

        // B) Feltöltünk egy kínálatot, ami illeszkedik
        BookOffer::factory()->create([
            'user'             => $this->user2->id,
            'publisher'        => $this->publisher->publisher_id,
            'work'             => $this->work->work_id,
            'language'         => 'hu',
            'publication_year' => 2020,
            'quality'          => 5,
            'book_status'      => 's',
            'img_url'          => 'https://via.placeholder.com/640x480',
        ]);

        // C) Most már matched státuszra kell váltania
        $this->assertDatabaseHas('book_demands', [
            'demand_id'     => $demand->demand_id,
            'demand_status' => 't',
        ]);
    }

    public function test_book_demand_triggers_offer_matching()
    {
        // A) Előbb a kínálat
        BookOffer::factory()->create([
            'user'             => $this->user2->id,
            'publisher'        => $this->publisher->publisher_id,
            'work'             => $this->work->work_id,
            'language'         => 'hu',
            'publication_year' => 2020,
            'quality'          => 5,
            'book_status'      => 's',
            'img_url'          => 'https://via.placeholder.com/640x480',
        ]);

        // B) Utána a keresés
        $demand = BookDemand::factory()->create([
            'user'                 => $this->user1->id,
            'publisher'            => $this->publisher->publisher_id,
            'work'                 => $this->work->work_id,
            'language'             => 'hu',
            'min_publication_year' => 2000,
            'max_publication_year' => 2025,
            //'demand_status'        => 's',
        ]);

        // C) A keresésnek azonnal 't'-vé kell válnia
        $this->assertDatabaseHas('book_demands', [
            'demand_id'     => $demand->demand_id,
            'demand_status' => 't',
        ]);
    }

}