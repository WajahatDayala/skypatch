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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');  // Auto-incrementing primary key
            $table->bigInteger('invoice_number')->unique();  // Invoice number as a big integer
            $table->tinyInteger('invoice_status')->default(0);  // Default invoice status
            $table->timestamps();
        });
    
        // Set the invoice_number auto increment starting from 100000
        DB::statement("ALTER TABLE invoices AUTO_INCREMENT = 100000;");
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
