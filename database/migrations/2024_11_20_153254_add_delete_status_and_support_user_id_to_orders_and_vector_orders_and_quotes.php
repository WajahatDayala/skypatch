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
        // Add columns to orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger('delete_status')->default(0); // replace 'column_name' with the last column name
            $table->unsignedBigInteger('support_user_id')->nullable();
        });

             // Add columns to vector_orders table
        Schema::table('vector_orders', function (Blueprint $table) {
            $table->tinyInteger('delete_status')->default(0); // replace 'column_name' with the last column name
            $table->unsignedBigInteger('support_user_id')->nullable();
        });

        // Add columns to quotes table
        Schema::table('quotes', function (Blueprint $table) {
            $table->tinyInteger('delete_status')->default(0); // replace 'column_name' with the last column name
            $table->unsignedBigInteger('support_user_id')->nullable();
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
