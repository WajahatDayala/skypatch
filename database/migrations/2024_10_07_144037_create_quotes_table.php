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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to users table
            $table->foreignId('required_format_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); // Foreign key to required_formats table
            $table->foreignId('fabric_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); // Foreign key to fabrics table
            $table->foreignId('placement_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); // Foreign key to placements table
            $table->foreignId('status_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); // Foreign key to statuses table
            $table->string('quote_id_edit')->nullable(); // Editable quote ID
            $table->timestamp('date_finalized')->nullable()->useCurrent(); // Auto-generated timestamp
            $table->string('name'); // Name
            $table->decimal('height', 8, 2)->nullable(); // Height
            $table->decimal('width', 8, 2)->nullable(); // Width
            $table->integer('number_of_colors')->nullable(); // Number of colors
            $table->text('additional_instruction')->nullable(); // Additional instructions
            $table->boolean('super_urgent')->default(false); // Super urgent flag
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
