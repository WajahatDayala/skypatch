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
        Schema::create('options', function (Blueprint $table) {
             $table->id();
             $table->foreignId('option_types_id')->constrained('option_types')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to option_types table
             $table->foreignId('role_id')->constrained('roles')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to roles table
             $table->foreignId('comment_id')->constrained('comments')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to comments table
             $table->string('name'); // Name
             $table->string('file_upload')->nullable(); // File Upload (nullable)
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
