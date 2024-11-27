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
        Schema::create('job_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')->nullable()->constrained('quotes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('vector_id')->nullable()->constrained('vector_orders')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('height_A')->nullable();
            $table->decimal('width_A')->nullable();
            $table->bigInteger('stitches_A')->nullable();
            $table->decimal('price_A')->nullable();
            $table->decimal('height_B')->nullable();
            $table->decimal('width_B')->nullable();
            $table->bigInteger('stitches_B')->nullable();
            $table->decimal('price_B')->nullable();
            $table->decimal('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_information');
    }
};
