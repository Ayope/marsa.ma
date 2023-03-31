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
        Schema::create('fishing_liscences', function (Blueprint $table) {
            $table->id();
            $table->string('license_number')->unique();
            $table->date('expiration_date');
            $table->date('issue_date');
            $table->string('type');
            $table->string('issuing_authority');
            $table->unsignedBigInteger('fisher_id');
            $table->foreign('fisher_id')->references('id')->on('users');
            $table->string('document')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fishing_liscences');
    }
};
