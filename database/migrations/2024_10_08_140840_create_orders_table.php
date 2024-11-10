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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to users table
            $table->foreignId('quote_id')->nullable()->constrained('quotes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('required_format_id')->constrained('required_formats')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to required_formats table
            $table->foreignId('fabric_id')->constrained('fabrics')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to fabrics table
            $table->foreignId('placement_id')->constrained('placements')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to placements table
            $table->string('edit_order_id')->nullable(); // Editable quote ID
            $table->foreignId('edit_reason_id')->nullable()->constrained('reason_edits')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('status_id')->constrained('statuses')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to statuses table
            $table->timestamp('sent_date')->nullable(); // Auto-generated timestamp convert from quote
            $table->string('name'); // Name
            $table->decimal('height', 8, 2)->nullable(); // Height
            $table->decimal('width', 8, 2)->nullable(); // Width
            $table->integer('number_of_colors')->nullable(); // Number of colors
            $table->foreignId('instruction_id')->nullable()->constrained('instructions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('delivery_type_id')->constrained('delivery_types')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE orders AUTO_INCREMENT = 1000;");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
