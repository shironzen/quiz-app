<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $quiz->title }} - Прохождение</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex flex-col font-sans text-gray-200" style="background-color: #141516; background-image: url('data:image/svg+xml,%3Csvg width=%22100%22 height=%22100%22 viewBox=%220 0 100 100%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M10 10 Q 50 0 90 10 Q 100 50 90 90 Q 50 100 10 90 Q 0 50 10 10%22 fill=%22none%22 stroke=%22%2326282b%22 stroke-width=%222%22/%3E%3C/svg%3E'); background-size: 100px 100px;">

    <x-header />

    <main class="flex-grow max-w-2xl mx-auto px-4 w-full mt-8">
        <div class="bg-slate-800 p-8 rounded-xl shadow-lg border border-slate-700">
            <h1 class="text-2xl font-bold text-white mb-2">{{ $quiz->title }}</h1>
            <p class="text-gray-400 mb-8">{{ $quiz->description }}</p>

            <!-- Вывод результата после завершения теста -->
            @if(session('result'))
                <div class="bg-indigo-900/50 border border-indigo-700 text-indigo-300 p-4 rounded-lg mb-6 text-center text-xl font-bold">
                    {{ session('result') }}
                </div>
            @endif

            <form method="POST" action="{{ route('quizzes.submit', $quiz->id) }}">
                @csrf
                
                @foreach($quiz->questions as $question)
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-white mb-4">{{ $question->question_text }}</h3>
                        
                        <div class="space-y-2">
                            @foreach($question->answers as $answer)
                                <label class="flex items-center p-3 bg-slate-900 rounded-lg border border-slate-700 cursor-pointer hover:bg-slate-800 transition">
                                    <!-- Имя поля answers[ID_вопроса] -->
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" class="mr-3 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-gray-200">{{ $answer->answer_text }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-500 transition shadow-md">
                    Завершить тест
                </button>
            </form>
        </div>
    </main>

    <x-footer />
</body>
</html>