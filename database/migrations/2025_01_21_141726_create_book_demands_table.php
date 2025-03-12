<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->foreignId('publisher')->references('publisher_id')->on('publishers')->nullable();
            $table->foreignId('work')->references('work_id')->on('works')->nullable();
            $table->string('language')->nullable();
            $table->integer('min_publication_year')->nullable();
            $table->integer('max_publication_year')->nullable();
            $table->char('demand_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_demands');
    }
};
