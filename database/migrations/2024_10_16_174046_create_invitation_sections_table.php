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
        Schema::create('invitation_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('body');
            $table->integer('order');
            $table->unsignedBigInteger('invitation_id');
            $table->foreign('invitation_id')->references('id')->on('invitations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation_sections');
    }
};
