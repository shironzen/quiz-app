<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['quiz_id', 'question_text'];

    // Связь: вопрос принадлежит тесту
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Связь: у одного вопроса много вариантов ответа
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}