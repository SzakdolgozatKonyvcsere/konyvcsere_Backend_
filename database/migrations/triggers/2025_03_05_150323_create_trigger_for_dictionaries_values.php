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
            create trigger check_demand_status_values before insert on book_demands
            for each row
            begin
                if not exists (select 1 from dictionaries where type = 'demand_status' and value = new.demand_status) then
                    signal sqlstate '45000' set message_text = 'invalid demand_status value';
                end if;
            end
        "); 

        DB::statement("
            create trigger check_book_status_values before insert on book_offers
            for each row
            begin
                if not exists (select 1 from dictionaries where type = 'book_status' and value = new.book_status) then
                    signal sqlstate '45000' set message_text = 'invalid book_status value';
                end if;
            end
        "); // 

        DB::statement("
            create trigger check_exchange_status_values before insert on exchange_histories
            for each row
            begin
                if not exists (select 1 from dictionaries where type = 'exchange_status' and value = new.exchange_status) then
                    signal sqlstate '45000' set message_text = 'invalid exchange_status value';
                end if;
            end
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("drop trigger if exists check_demand_status_values");
        DB::statement("drop trigger if exists check_book_status_values");
        DB::statement("drop trigger if exists check_exchange_status_values");
    }
};
