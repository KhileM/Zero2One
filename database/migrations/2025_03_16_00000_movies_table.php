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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->index();
            $table->string('imdb_id')->unique();
            $table->string('title');
            $table->text('poster')->nullable(); // Allows long URLs
            $table->year('year'); // Ensures correct format
            $table->string('rating', 5)->nullable()->default('N/A'); // Keeps ratings short
            $table->boolean('pinned')->default(false); // Feature for pinning
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
