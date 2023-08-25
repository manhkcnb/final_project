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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->integer('category_id');
            $table->integer('price');
          
            $table->string('photo');
            $table->timestamp('custom_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('custom_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP')); 
            $table->foreign('category_id')->references('id')->on('category');
            
           
        });
        
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
