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
        Schema::create('blog_social_media', function (Blueprint $table) {
            $table->id();
            $table->string('bsm_facebook')->nullable();
            $table->string('bsm_instagram')->nullable();
            $table->string('bsm_youtube')->nullable();
            $table->string('bsm_linkedin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_social_media');
    }
};
