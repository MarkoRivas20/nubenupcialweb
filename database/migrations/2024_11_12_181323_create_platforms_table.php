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
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('text');
            $table->string('verification_code');
            $table->integer('qty_photos');
            $table->integer('qty_users');
            $table->string('background');
            $table->string('background2');
            $table->string('load_background');
            $table->string('load_logo');
            $table->string('icon');
            $table->string('qr')->nullable();
            $table->boolean('status')->default(false);
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platforms');
    }
};
