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
        Schema::table('tables', function (Blueprint $table) {
            //
        });
        {
            DB::statement("
                ALTER TABLE book_demands 
                ADD CONSTRAINT check_demand_status_values 
                CHECK (exchange_status IN ('e', 'k', 't'))
            ");
    
            DB::statement("
                ALTER TABLE book_offers
                ADD CONSTRAINT check_book_status_values 
                CHECK (book_status IN ('e', 'f', 's'))
            ");
    
            DB::statement("
                ALTER TABLE exchange_histories 
                ADD CONSTRAINT check_exchange_status_values 
                CHECK (exchange_status IN ('a', 'k', 'f', 'v'))
            ");
        }
    }

    public function down(): void
    {
        {
            DB::statement("ALTER TABLE book_demands DROP CONSTRAINT check_demand_status_values");
            DB::statement("ALTER TABLE book__offers DROP CONSTRAINT check_book_status_values");
            DB::statement("ALTER TABLE exchange_histories DROP CONSTRAINT check_exchange_status_values");
        }
    }
};
