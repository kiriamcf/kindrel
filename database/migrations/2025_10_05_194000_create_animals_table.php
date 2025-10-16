<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->foreignId('species_id')->constrained()->onDelete('cascade');
            $table->foreignId('breed_id')->constrained()->onDelete('cascade');
            $table->integer('age');
            $table->dateTime('arrival_date');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
