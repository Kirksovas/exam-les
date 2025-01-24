<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('places', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');
        $table->boolean('repair')->default(false); // Флаг ремонта
        $table->boolean('work')->default(false); // В рабочем процессе
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
