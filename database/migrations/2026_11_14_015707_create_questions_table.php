<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('questions', function (Blueprint $table) {
            $table->id(); // ID вопроса
            $table->foreignId('quiz_id')->constrained('quizzes')->cascadeOnDelete(); // К какому тесту относится
            $table->text('question_text'); // Текст вопроса
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('questions');
    }
};