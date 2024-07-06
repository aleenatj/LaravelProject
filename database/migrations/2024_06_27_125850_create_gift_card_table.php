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
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->id();
        
            $table->string('code')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->string('from');
            $table->string('to_mail');
            $table->decimal('amount', 8, 2);
            $table->decimal('balance', 8, 2);
            $table->date('expiry_date')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->default('active'); // Change here
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_cards');
    }
};