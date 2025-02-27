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
}