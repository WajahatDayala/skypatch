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
        Schema::create('vector_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to users table
            $table->foreignId('required_format_id')->constrained('vector_required_formats')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to required_formats table
            $table->string('edit_vector_id')->nullable(); // Editable quote ID
            $table->foreignId('status_id')->constrained('statuses')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to statuses table
            $table->string('name'); // Name
            $table->integer('number_of_colors')->nullable(); // Number of colors
            $table->boolean('super_urgent')->default(false); // Super urgent flag
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vector_orders');
    }
};
