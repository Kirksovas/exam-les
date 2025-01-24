<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
{
    Schema::create('things', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');
        $table->date('wrnt')->nullable(); 
        $table->foreignId('master')->constrained('users'); 
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('things');
    }
};
