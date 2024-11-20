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
        Schema::create('image_platforms', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('message')->nullable();
            $table->unsignedBigInteger('platform_user_id');
            $table->foreign('platform_user_id')->references('id')->on('platform_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_platforms');
    }
};
