<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_book_demands');
        DB::statement("
            CREATE VIEW view_book_demands AS
            SELECT users.id, users.full_name, book_demands.work AS work_id, works.title
            FROM book_demands
            JOIN users ON book_demands.user = users.id
            JOIN works ON book_demands.work = works.work_id
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_book_demands');
    }
};
