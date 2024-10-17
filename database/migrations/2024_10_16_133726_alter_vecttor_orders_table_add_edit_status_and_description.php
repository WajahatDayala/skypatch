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
            // Set default value for edit_status and make description nullable
            $table->integer('edit_status')->default(1)->after('edit_vector_id'); // Replace 'some_column' with the appropriate column name
            $table->text('description')->nullable()->after('edit_status'); // Adjust if needed

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
