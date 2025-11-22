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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId("package_id");
            $table->string("title");
            $table->string('slug')->unique();
            $table->enum('content_type', ['video', 'image']);
            $table->enum('source_type', ['file', 'url']);
            $table->string("source");
            $table->string("thumbnail");
            $table->boolean('is_premium');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
