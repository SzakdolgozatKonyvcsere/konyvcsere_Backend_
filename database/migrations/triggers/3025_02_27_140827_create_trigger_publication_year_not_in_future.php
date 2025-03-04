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
            CREATE TRIGGER publication_year_not_in_future_insert
            AFTER INSERT ON book_offers
            FOR EACH ROW
            BEGIN
                IF NEW.publication_year > YEAR(CURDATE()) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Hiba! Jövőbeli kiadási dátum nem megengedett.';
                END IF;
            END
        ");
        DB::statement("
            CREATE TRIGGER publication_year_not_in_future_update
            BEFORE UPDATE ON book_offers
            FOR EACH ROW
            BEGIN
                IF NEW.publication_year > YEAR(CURDATE()) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Hiba! Jövőbeli kiadási dátum nem megengedett.';
                END IF;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TRIGGER IF EXISTS publication_year_not_in_future_insert");
        DB::statement("DROP TRIGGER IF EXISTS publication_year_not_in_future_update");
    }
};
