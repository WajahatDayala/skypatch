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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade'); // Foreign key to invoices table
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade'); // Nullable foreign key to orders table
            $table->foreignId('vector_id')->nullable()->constrained('vector_orders')->onDelete('cascade'); // Nullable foreign key to vector_orders table
            $table->decimal('price', 10, 2);  // Price for the order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};
