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
        Schema::create('book_demands', function (Blueprint $table) {
            $table->id('demand_id');
            $table->foreignId('user')->references('id')->on('users');
            $table->foreignId('publisher')->nullable()->references('publisher_id')->on('publishers');
            $table->foreignId('work')->nullable()->references('work_id')->on('works');
            $table->string('language')->nullable();
            $table->integer('min_publication_year')->nullable();
            $table->integer('max_publication_year')->nullable();
            $table->char('demand_status')->default('k'); //keres
            $table->timestamps();
        });

        DB::statement("
            ALTER TABLE book_demands
            ADD CONSTRAINT chk_publication_year_order
            CHECK (min_publication_year <= max_publication_year)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_demands');
    }
};
