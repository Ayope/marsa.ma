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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('registration_matricule');
            $table->string('make');
            $table->string('model');
            $table->integer('capacity');
            $table->string('photo')->nullable();
            $table->string('type');
            $table->string('insurance');
            $table->unsignedBigInteger('delivery_man_id');
            $table->foreign('delivery_man_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
