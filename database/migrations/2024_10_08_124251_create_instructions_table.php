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
        Schema::create('instructions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cust_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('emp_id')->nullable()->constrained('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->text('description')->nullable(); // Description field
            $table->foreignId('quote_id')->nullable()->constrained('quotes')->onDelete('cascade')->onUpdate('cascade'); // Related to quotes table
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructions');
    }
};
