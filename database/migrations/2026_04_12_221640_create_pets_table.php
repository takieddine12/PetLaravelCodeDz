<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('petInfo', function (Blueprint $table) {
    $table->string('petID')->primary(); // ✅ MAKE IT PRIMARY

    $table->string('petName');
    $table->string('petCategory');
    $table->string('petBreed');
    $table->string('gender');
    $table->string('age');
    $table->string('city');
    $table->string('status');
    $table->text('description');
    $table->string('image');
    $table->string('isAdded');
    $table->string('userID');
    $table->string('phoneNumber');
    $table->string('email');
    $table->string('latitude');
    $table->string('longitude');
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('petInfo');
    }
};