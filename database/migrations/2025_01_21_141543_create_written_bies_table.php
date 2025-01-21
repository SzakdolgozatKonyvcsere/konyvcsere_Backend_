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
        Schema::create('written_bies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work')->references('id')->on('works');
            $table->foreignId('author')->references('id')->on('authors');
            $table->primary(['work', 'author']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('written_bies');
    }
};
