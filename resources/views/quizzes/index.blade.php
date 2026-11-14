<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizMaster - Тесты</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex flex-col font-sans text-gray-200" style="
    background-color: #141516; 
    background-image: url('data:image/svg+xml,%3Csvg width=%22100%22 height=%22100%22 viewBox=%220 0 100 100%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M10 10 Q 50 0 90 10 Q 100 50 90 90 Q 50 100 10 90 Q 0 50 10 10%22 fill=%22none%22 stroke=%22%2326282b%22 stroke-width=%222%22/%3E%3C/svg%3E'); 
    background-size: 100px 100px;
">

    <x-header />

    <main class="flex-grow max-w-4xl mx-auto px-4 w-full mt-8">
        <h2 class="text-2xl font-semibold mb-6 text-white">Доступные тесты</h2>

        @if(session('success'))
            <div class="bg-green-900/50 border border-green-700 text-green-300 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-4">
            @forelse($quizzes as $quiz)
                <div class="bg-slate-800 p-6 rounded-xl shadow-lg border border-slate-700 hover:border-indigo-500 transition flex flex-col justify-between">
                    <div>
                        <!-- Ссылка на прохождение теста -->
                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="block">
                            <h3 class="text-lg font-bold text-white">{{ $quiz->title }}</h3>
                            <p class="text-gray-400 mt-2">{{ $quiz->description ?? 'Без описания' }}</p>
                        </a>
                    </div>
                    
                    <div class="mt-4 flex justify-between items-center border-t border-slate-700 pt-4">
                        <div class="text-sm text-gray-500">
                            Автор: {{ $quiz->user->login ?? 'Неизвестен' }}
                        </div>

                        <!-- Кнопка удаления (только для автора теста) -->
                        @if(Auth::check() && Auth::id() === $quiz->user_id)
                            <form method="POST" action="{{ route('quizzes.destroy', $quiz->id) }}" onsubmit="return confirm('Вы уверены, что хотите удалить этот тест?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 transition text-sm font-medium">
                                    Удалить
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-400 py-10 bg-slate-800 rounded-xl shadow-lg border border-slate-700">
                    Пока нет ни одного теста. Создайте первый!
                </div>
            @endforelse
        </div>
        
        <div class="mt-6 mb-8">
            {{ $quizzes->links() }}
        </div>
    </main>

    <x-footer />

</body>
</html>