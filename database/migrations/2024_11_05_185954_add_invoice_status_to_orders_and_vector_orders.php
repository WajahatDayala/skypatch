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
         // Add invoice_status column to orders table
         Schema::table('orders', function (Blueprint $table) {
            // Add column after 'payment_status'
            $table->tinyInteger('invoice_status')->default(0)->after('payment_status');
        });

        // Add invoice_status column to vector_orders table
        Schema::table('vector_orders', function (Blueprint $table) {
            // Add column after 'payment_status'
            $table->tinyInteger('invoice_status')->default(0)->after('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
