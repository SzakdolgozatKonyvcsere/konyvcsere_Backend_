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
        // Ez egy constraint lenne alapból
        /*DB::statement("
            CREATE TRIGGER check_book_search_release_date_insert
            BEFORE INSERT ON book_demands
            FOR EACH ROW
            BEGIN
                IF NEW.min_publication_year > NEW.max_publication_year THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Hiba! A minimum kiadási év nem lehet nagyobb a maximum kiadási évnél!';
                END IF;
            END;
        ");

        DB::statement("
            CREATE TRIGGER check_book_search_release_date_update
            BEFORE UPDATE ON book_demands
            FOR EACH ROW
            BEGIN
                IF NEW.min_publication_year > NEW.max_publication_year THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Hiba! A minimum kiadási év nem lehet nagyobb a maximum kiadási évnél!';
                END IF;
            END;
        "); */
        
        // Check constraintre javitva
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //DB::statement(query: 'DROP TRIGGER IF EXISTS check_konyv_keres_ev');
    }
};
