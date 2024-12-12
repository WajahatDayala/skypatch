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
        Schema::table('invoices', function (Blueprint $table) {
            //
               // Add the foreign key column
               $table->unsignedBigInteger('billingtype_id')->nullable();

               // Add the foreign key constraint with CASCADE on DELETE and UPDATE
               $table->foreign('billingtype_id')
                     ->references('id')
                     ->on('billing_types')
                     ->onDelete('cascade')  // Automatically delete invoices when billing type is deleted
                     ->onUpdate('cascade'); // Automatically update billingtype_id if the billing type id is updated
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            //
        });
    }
};
