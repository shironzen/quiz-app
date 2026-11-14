<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    // Разрешаем записывать эти поля при создании теста
    protected $fillable = ['title', 'description', 'user_id'];

    // Связь: у одного теста много вопросов
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Связь: тест принадлежит одному автору (пользователю)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}