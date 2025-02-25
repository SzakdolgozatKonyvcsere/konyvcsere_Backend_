<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW book_offers_view AS
            SELECT 
                works.title,
                publishers.publisher_name,
                book_offers.book_status
            FROM book_offers
            JOIN works ON book_offers.work = works.work_id
            JOIN publishers ON book_offers.publishers = publishers.publisher_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_offers_by_user_view');
    }
};
