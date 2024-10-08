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
        Schema::create('quote_file_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')->nullable()->constrained('quotes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('vector_order_id')->nullable()->constrained('vector_orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('cust_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('emp_id')->nullable()->constrained('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->text('files')->unique();    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_file_logs');
    }
};
