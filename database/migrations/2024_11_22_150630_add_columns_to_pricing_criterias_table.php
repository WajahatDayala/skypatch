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
        Schema::table('pricing_criterias', function (Blueprint $table) {
            //
              // Add the unsigned, non-nullable customer_id column
              $table->unsignedInteger('customer_id')->notNullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pricing_criterias', function (Blueprint $table) {
            //
        });
    }
};
