<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favPetInfo', function (Blueprint $table) {

            $table->string('petID')->primary();

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

            // ❗ important if you use Laravel timestamps
            // $table->timestamps(); // enable ONLY if you need it
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favPetInfo');
    }
};