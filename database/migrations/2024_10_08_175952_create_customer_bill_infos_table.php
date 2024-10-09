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
        Schema::create('customer_bill_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to users table
            $table->string('card_holder_name')->nullable(); // Card Holder Name
            $table->foreignId('card_type_id')->nullable()->constrained('card_types')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to card_types table
            $table->string('card_number')->nullable(); // Card Number
            $table->string('card_expiry')->nullable(); // Card Expiry
            $table->string('vcc')->nullable(); // VCC
            $table->string('address')->nullable(); // Address
            $table->string('city')->nullable(); // City
            $table->string('state')->nullable(); // State
            $table->string('zipcode')->nullable(); // ZipCode
            $table->string('country')->nullable(); // Country
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_bill_infos');
    }
};
