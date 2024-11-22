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
        Schema::create('vector_details', function (Blueprint $table) {
            $table->id();
            // Foreign key column
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); 
            // Other fields
            $table->decimal('machine', 8, 2)->nullable(); 
            $table->decimal('condition', 8, 2)->nullable(); 
            $table->integer('needles')->nullable(); 
            $table->integer('thread')->nullable(); 
            $table->string('needle_brand')->nullable(); 
            $table->string('backing_pique_jersey)')->nullable(); 
            $table->string('brand')->nullable();
            $table->string('backing_cotton_twill)')->nullable(); 
            $table->string('backing_cap)')->nullable(); 
            $table->string('backing)')->nullable(); 
            $table->string('needle_number)')->nullable(); 
            $table->string('head)')->nullable(); 
            $table->text('comment_box')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vector_details');
    }
};
