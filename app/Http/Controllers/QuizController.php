<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // 1. Главная страница со списком всех тестов
    public function index()
    {
        $quizzes = Quiz::orderBy('created_at', 'desc')->paginate(5);
        return view('quizzes.index', compact('quizzes'));
    }

    // 2. Форма создания теста
    public function create()
    {
        return view('quizzes.create');
    }

    // 3. Сохранение теста, вопросов и ответов
    public function store(Request $request)
    {
        // Строгая валидация: проверяем, что каждая строка с вопросами написана по шаблону
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions_text' => ['required', 'string', function ($attribute, $value, $fail) {
                $lines = explode("\n", $value);
                foreach ($lines as $line) {
                    if (trim($line) === '') continue;
                    
                    $parts = explode('|', $line);
                    if (count($parts) < 3) {
                        return $fail('Каждый вопрос должен быть в формате: Вопрос | Вариант1, Вариант2 | Правильный ответ. Проверьте строку: ' . $line);
                    }
                }
            }],
        ]);

        // Создаем сам тест
        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        // Разбиваем текст на строки (каждая строка - новый вопрос)
        $lines = explode("\n", $request->questions_text);

        foreach ($lines as $line) {
            if (trim($line) === '') continue;

            $parts = explode('|', $line);

            $questionText = trim($parts[0]);
            $answersList = explode(',', $parts[1]);
            $correctAnswer = trim($parts[2]);

            // Создаем вопрос
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $questionText,
            ]);

            // Создаем варианты ответов
            foreach ($answersList as $answerText) {
                $answerText = trim($answerText);
                if ($answerText === '') continue;

                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $answerText,
                    'is_correct' => ($answerText === $correctAnswer),
                ]);
            }
        }

        return redirect('/quizzes')->with('success', 'Тест успешно создан!');
    }

    // 4. Показ страницы прохождения теста
    public function show($id)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        return view('quizzes.show', compact('quiz'));
    }

    // 5. Подсчет баллов после прохождения
    public function submit(Request $request, $id)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        $score = 0;
        $total = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $selectedAnswerId = $request->input('answers.' . $question->id);
            $selectedAnswer = $question->answers->find($selectedAnswerId);

            if ($selectedAnswer && $selectedAnswer->is_correct) {
                $score++;
            }
        }

        return redirect()->route('quizzes.show', $quiz->id)->with('result', "Вы набрали $score из $total!");
    }

    // 6. Удаление теста
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        
        if ($quiz->user_id !== Auth::id()) {
            abort(403, 'Вы не можете удалять чужие тесты');
        }

        $quiz->delete();
        return redirect('/quizzes')->with('success', 'Тест успешно удален!');
    }
}