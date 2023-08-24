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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->string('customer_email');
            $table->string('name');
            $table->string('color');
            $table->string('size');
            $table->integer('price'); 
            $table->integer('quantity');
            $table->string('photo');
            $table->foreign('customer_email')->references('email')->on('users');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};

