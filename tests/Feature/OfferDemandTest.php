<?php


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\{User, Genre, Publisher, Author, Work, BookDemand, BookOffer};
use Database\Seeders\DictionariesTableSeeder;

class OfferDemandTest extends TestCase
{
    use RefreshDatabase;

    protected \App\Models\User $user;
    protected \App\Models\Publisher $publisher;
    protected \App\Models\Author $author;
    protected \App\Models\Work $work;

    protected function setUp(): void
    {
        parent::setUp();

         // --- IDE ADDIG NEM LESZ DICTIONARY ---
         $this->seed(DictionariesTableSeeder::class);

        // 1. Bejelentkezett user
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user, ['*']);

        // 2. Kellék rekordok
        $genre = Genre::factory()->create();
        $this->publisher = Publisher::factory()->create(['publisher_name'=>'Teszt Kiadó']);
        $this->author    = Author::factory()->create(['author_name'=>'Kovács Péter']);
        $this->work      = Work::factory()->create([
            'genre_id' => $genre->genre_id,
            'title'    => 'Teszt Könyv',
        ]);
        $this->work->authors()->attach($this->author->author_id);
    }

   
    public function test_index_returns_user_demands_in_expected_structure()
    {
        // Először kreálunk egy keresést
        BookDemand::factory()->create([
            'user'                 => $this->user->id,
            'publisher'            => $this->publisher->publisher_id,
            'work'                 => $this->work->work_id,
            'language'             => 'hu',
            'min_publication_year' => 2000,
            'max_publication_year' => 2025,
            'demand_status'        => 'k',
        ]);

        $response = $this->getJson('/api/book-demands-list');

        $response->assertJsonStructure([
            '*' => [
              'demand_id',
              'user',
              'publisher',
              'work',
              'language',
              'min_publication_year',
              'max_publication_year',
              'demand_status',
              'created_at',
              'updated_at',
              'work_model'   => [
                 'work_id','title','genre_id','created_at','updated_at'
              ]
            ],
          ]);
    }

    
    public function test_store_creates_new_demand_and_returns_it()
    {
        $payload = [
            'user'                 => $this->user->id, 
            'title'                => 'Teszt Könyv',
            'publisher_name'            => 'Teszt Kiadó',
            'genre_id'             => $this->work->genre_id,
            'authors'               => 'Kovács Péter',
            'language'             => 'hu',
            'min_publication_year' => 2000,
            'max_publication_year' => 2025,
        ];

        $response = $this->postJson('/api/keresesfeltoltes', $payload);

        $response->assertStatus(201)
         ->assertJsonPath('message', 'Könyv keresés sikeresen feltöltve!')
         // a data.work_model.title alatt keresd a címet
         ->assertJsonPath('data.work_model.title', 'Teszt Könyv')
         // a publisher FK-t pedig így:
         ->assertJsonPath('data.publisher', $this->publisher->publisher_id)
         ->assertJsonPath('data.min_publication_year', 2000)
         ->assertJsonPath('data.max_publication_year', 2025);

        $this->assertDatabaseHas('book_demands', [
            'user'                 => $this->user->id,
            'publisher'            => $this->publisher->publisher_id,
            'work'                 => $this->work->work_id,
            'min_publication_year' => 2000,
            'max_publication_year' => 2025,
            'demand_status'        => 'k',
        ]);
    }

    
    public function test_matches_endpoint_returns_offers_for_given_demand()
    {
        // 1) Először keresés, 2) Utána érkező ajánlat
        $demand = BookDemand::factory()->create([
            'user'                 => $this->user->id,
            'publisher'            => $this->publisher->publisher_id,
            'work'                 => $this->work->work_id,
            'language'             => 'hu',
            'min_publication_year' => 2000,
            'max_publication_year' => 2025,
            'demand_status'        => 'k',
        ]);

        BookOffer::factory()->create([
            'user'             => $this->user->id,
            'publisher'        => $this->publisher->publisher_id,
            'work'             => $this->work->work_id,
            'language'         => 'hu',
            'publication_year' => 2020,
            'quality'          => 5,
            'book_status'      => 's',
            'img_url'          => 'https://via.placeholder.com/640x480',
        ]);

        $response = $this->getJson("/api/book-demands-list/{$demand->demand_id}/matches");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id',
                         'title',
                         'publisher',
                         'authors',
                         'language',
                         'year',
                         'quality',
                         'status',
                         'image_url',
                     ],
                 ]);
    }
}

