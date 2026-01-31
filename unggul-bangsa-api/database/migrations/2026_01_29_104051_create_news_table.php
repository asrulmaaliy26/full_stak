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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
             // $table->string('slug')->unique(); // Optional: add if we want slugs for URLs
            $table->text('excerpt');
            $table->longText('content');
            $table->date('date');
            $table->integer('views')->default(0);
            $table->string('category');
            $table->string('jenjang');
            $table->string('main_image');
            $table->json('gallery')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
