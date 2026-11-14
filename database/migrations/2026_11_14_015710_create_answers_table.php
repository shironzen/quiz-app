<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('answers', function (Blueprint $table) {
            $table->id(); // ID ответа
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete(); // К какому вопросу
            $table->string('answer_text'); // Текст варианта ответа
            $table->boolean('is_correct')->default(false); // Правильный или нет
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('answers');
    }
};