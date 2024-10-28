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
        Schema::table('vector_orders', function (Blueprint $table) {
            //
            $table->integer('vector_status')->default(3)->after('delivery_type_id'); // Specify the position

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vector_orders', function (Blueprint $table) {
            //
        });
    }
};
