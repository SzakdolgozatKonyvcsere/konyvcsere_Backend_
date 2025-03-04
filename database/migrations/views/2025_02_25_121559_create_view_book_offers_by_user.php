<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_book_offers_by_user');
        DB::statement("
            CREATE VIEW view_book_offers_by_user AS
            SELECT works.title, publishers.publisher_name, book_offers.book_status
            FROM book_offers
            JOIN works ON book_offers.work = works.work_id
            JOIN publishers ON book_offers.publisher = publishers.publisher_id
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_book_offers_by_user');
    }
};
