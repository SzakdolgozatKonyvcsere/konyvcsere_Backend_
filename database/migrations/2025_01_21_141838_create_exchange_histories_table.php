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
        Schema::create('exchange_histories', function (Blueprint $table) {
            $table->id('exchange_id');
            $table->foreignId('interested_user')->references('id')->on('users');
            $table->foreignId('desired_item')->references('offer_id')->on('book_offers');
            $table->foreignId('offered_item')->nullable()->references('offer_id')->on('book_offers');
            $table->char('exchange_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_histories');
    }
};
