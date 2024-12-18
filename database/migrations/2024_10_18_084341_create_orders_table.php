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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('pdf_path')->nullable();
            $table->json('content');
            $table->integer('payment_method');
            $table->string('payment_id')->nullable();
            $table->float('total');
            $table->float('tax');
            $table->float('discount')->default(0.00);
            $table->string('promo_code')->nullable();
            $table->integer('status')->default(1);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
