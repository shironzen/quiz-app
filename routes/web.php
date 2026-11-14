<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController; // <- Перенесли сюда, наверх!

// Главная страница (заменили welcome на список тестов)
Route::get('/', [QuizController::class, 'index']);

// Список всех тестов
Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');

// Форма создания теста
Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');

// Сохранение теста
Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');

Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');
Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');
Route::post('/quizzes/{id}', [QuizController::class, 'submit'])->name('quizzes.submit'); // <-- Новый роут для отправки
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::delete('/quizzes/{id}', [QuizController::class, 'destroy'])->name('quizzes.destroy');