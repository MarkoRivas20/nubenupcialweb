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
        Schema::create('invitation_attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->string('key');
            $table->string('value');
            $table->unsignedBigInteger('invitation_section_id');
            $table->foreign('invitation_section_id')->references('id')->on('invitation_sections');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation_attributes');
    }
};
