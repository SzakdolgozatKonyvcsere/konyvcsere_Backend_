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
        Schema::create('book_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user')->references('id')->on('users');
            $table->foreignId('publisher')->references('id')->on('publishers');
            $table->foreignId('work')->references('id')->on('works');
            $table->string('language');
            $table->integer('publication_year');
            $table->integer('quality');
            $table->integer('book_status');
            //$table->string('img_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_offers');
    }
};
