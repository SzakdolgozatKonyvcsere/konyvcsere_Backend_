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
        DB::unprepared("DROP PROCEDURE IF EXISTS proc_book_offers_by_quality;");
        DB::unprepared("
        create procedure proc_book_offers_by_quality (
            in p_operator varchar(2),
            in p_quality int
        )
        begin
            if p_operator = '<' then
                select * from book_offers where quality < p_quality;
            elseif p_operator = '<=' then
                select * from book_offers where quality <= p_quality;
            elseif p_operator = '>' then
                select * from book_offers where quality > p_quality;
            elseif p_operator = '>=' then
                select * from book_offers where quality >= p_quality;
            elseif p_operator = '=' then
                select * from book_offers where quality = p_quality;
            else
                signal sqlstate '45000' set message_text = 'Hiba! Érvénytelen operátor';
            end if;
        end
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS proc_book_offers_by_quality');
    }
};
