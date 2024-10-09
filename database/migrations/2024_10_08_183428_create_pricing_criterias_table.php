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
        Schema::create('pricing_criterias', function (Blueprint $table) {
            $table->id();

            // Foreign key column
            $table->foreignId('delivery_type_id')->constrained('delivery_types')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to delivery_types table

            // Other fields
            $table->decimal('minimum_price', 8, 2)->nullable(); // Minimum Price
            $table->decimal('maximum_price', 8, 2)->nullable(); // Maximum Price
            $table->integer('stitches')->nullable(); // 1000 stitches (can be an integer or you can adjust as needed)
            $table->string('editing_changes')->nullable(); // Editing/Changes
            $table->string('editing_in_stitch_file')->nullable(); // Editing in Stitch File
            $table->text('comment_box_1')->nullable(); // Comment Box 1
            $table->text('comment_box_2')->nullable(); // Comment Box 2
            $table->text('comment_box_3')->nullable(); // Comment Box 3
            $table->text('comment_box_4')->nullable(); // Comment Box 4
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_criterias');
    }
};
