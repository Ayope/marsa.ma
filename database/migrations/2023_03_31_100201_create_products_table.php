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
            $table->string('title');
            $table->string('fish_type');
            $table->string('photo');
            $table->integer('quantity');
            $table->float('price');
            $table->date('date_of_fishing');
            $table->text('description');
            $table->enum('status', ['available', 'archived', 'sold out', 'rejected'])->default('available')->nullable();  // (available - sold out (archive))
            $table->unsignedBigInteger('fisher_id');
            $table->foreign('fisher_id')->references('id')->on('users');
            $table->timestamps();
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
