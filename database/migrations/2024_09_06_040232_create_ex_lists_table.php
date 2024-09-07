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
        Schema::create('ex_lists', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('fotoMantan');
            $table->enum('status', ['musuh', 'asing', 'teman']);
            $table->integer('lama_pacaran');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ex_lists');
    }
};
