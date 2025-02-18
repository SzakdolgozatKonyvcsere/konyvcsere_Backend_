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
            $table->foreignId('work')->references('work_id')->on('works');
            $table->foreignId('author')->references('author_id')->on('authors');
            $table->timestamps();
            $table->primary(['work', 'author']);
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
