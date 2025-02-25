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
            CREATE VIEW book_demands_view AS
            SELECT 
                users.id,
                users.full_name,
                book_demands.work AS work_id,
                works.title
            FROM book_demands
            JOIN users ON book_demands.user = users.id
            JOIN works ON book_demands.work = works.work_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_demands_with_users_view');
    }
};
