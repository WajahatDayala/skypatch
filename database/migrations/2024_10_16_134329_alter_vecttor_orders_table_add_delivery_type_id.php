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
        //
        Schema::table('vector_orders', function (Blueprint $table) {
          
            $table->foreignId('delivery_type_id')->constrained('delivery_types')->onDelete('cascade')->onUpdate('cascade')->default(2);
            

        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
