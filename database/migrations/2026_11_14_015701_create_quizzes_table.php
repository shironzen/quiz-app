<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id(); // ID теста
            $table->string('title'); // Название теста
            $table->text('description')->nullable(); // Описание
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Автор (кто создал)
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('quizzes');
    }
};