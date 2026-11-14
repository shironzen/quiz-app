<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать тест</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex flex-col font-sans text-gray-200" style="background-color: #141516; background-image: url('data:image/svg+xml,%3Csvg width=%22100%22 height=%22100%22 viewBox=%220 0 100 100%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M10 10 Q 50 0 90 10 Q 100 50 90 90 Q 50 100 10 90 Q 0 50 10 10%22 fill=%22none%22 stroke=%22%2326282b%22 stroke-width=%222%22/%3E%3C/svg%3E'); background-size: 100px 100px;">

    <x-header />

    <main class="flex-grow max-w-2xl mx-auto px-4 w-full mt-8">
        <div class="bg-slate-800 p-8 rounded-xl shadow-lg border border-slate-700">
            <h2 class="text-2xl font-bold mb-6 text-white">Создание нового теста</h2>

            @if ($errors->any())
                <div class="bg-red-900/50 border border-red-700 text-red-300 p-4 rounded-lg mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/quizzes">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Название теста</label>
                    <input type="text" name="title" class="w-full bg-slate-900 border border-slate-600 rounded-md p-2 text-white focus:outline-none focus:border-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Описание (необязательно)</label>
                    <textarea name="description" rows="2" class="w-full bg-slate-900 border border-slate-600 rounded-md p-2 text-white focus:outline-none focus:border-indigo-500"></textarea>
                </div>

                <hr class="my-6 border-slate-700">

                <h3 class="text-lg font-semibold mb-2 text-white">Вопросы</h3>
                <p class="text-sm text-gray-400 mb-4">
                    Вводите каждый вопрос с новой строки в формате:<br>
                    <code class="bg-slate-900 p-1 rounded text-indigo-300">Текст вопроса | Вариант1, Вариант2, Вариант3 | Правильный ответ</code>
                </p>
                
                <div class="bg-slate-900/50 p-4 rounded-lg mb-4 border border-slate-700">
                    <textarea name="questions_text" rows="8" class="w-full bg-slate-800 border border-slate-600 rounded-md p-2 text-white focus:outline-none focus:border-indigo-500" required></textarea>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-500 transition shadow-md mt-4">
                    Сохранить тест
                </button>
            </form>
        </div>
    </main>

    <x-footer />

</body>
</html>