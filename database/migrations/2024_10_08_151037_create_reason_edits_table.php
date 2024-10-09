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
        Schema::create('reason_edits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_id')->nullable()->constrained('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->text("reason");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reason_edits');
    }
};
