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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('email'); // Felhasználó email címe
            $table->unsignedBigInteger('subject_id'); // Tantárgyhoz kapcsolódó foreign key
            $table->unsignedBigInteger('question_id'); // Kérdéshez kapcsolódó foreign key
            $table->unsignedBigInteger('answer_id'); // Válaszhoz kapcsolódó foreign key
            $table->boolean('is_correct'); // Helyes volt-e a válasz
            $table->integer('score'); // Elért pontszám az adott kérdésnél
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
