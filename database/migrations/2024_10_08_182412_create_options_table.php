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
        Schema::create('options', function (Blueprint $table) {
             $table->id();
            //  $table->foreignId('option_types_id')->constrained('option_types')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to option_types table
             $table->foreignId('role_id')->constrained('roles')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to roles table
             $table->foreignId('employee_id')->nullable()->constrained('admins')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to roles table
             $table->foreignId('quote_id')->nullable()->constrained('quotes')->onDelete('cascade')->onUpdate('cascade');
             $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade')->onUpdate('cascade');
             $table->foreignId('vector_order_id')->nullable()->constrained('vector_orders')->onDelete('cascade')->onUpdate('cascade'); 
             $table->string('option'); // Name
             $table->text('comment');
             $table->string('file_upload'); // File Upload (nullable)
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
