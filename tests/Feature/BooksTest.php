<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BooksTest extends TestCase
{
    public function test_all_offered_books(): void
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

    /*public function test_most_exchanged_genre(): void
    {
        $response = $this->get('/api/most-exchanged-genre');

        $response->assertStatus(200);
    }
    
    public function test_most_exchanged_city(): void
    {
        $response = $this->get('/api/most-exchanged-city');

        $response->assertStatus(200);
    }*/

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
}