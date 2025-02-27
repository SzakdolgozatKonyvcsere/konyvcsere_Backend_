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
        DB::statement('DROP VIEW IF EXISTS view_book_offers_admin');
        DB::statement("
            CREATE VIEW view_book_offers_admin AS
            SELECT u.name, p.publisher_name, w.title, b.language, b.publication_year, b.quality, b.book_status, b.created_at, b.updated_at
            FROM book_offers b
                inner join users u on u.id=b.user
                inner join publishers p on p.publisher_id=b.publisher
                inner join works w on w.work_id=b.work
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_book_offers_admin');
    }
};
