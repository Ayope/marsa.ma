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
        Schema::create('driving_lisenses', function (Blueprint $table) {
            $table->id();
            $table->string('license_number')->unique();
            $table->date('issue_date');
            $table->date('expiration_date');
            $table->string('issuing_place');
            $table->char('class', 1);
            $table->string('document')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('driving_lisenses');
    }
};
