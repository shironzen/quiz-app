<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход - QuizMaster</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex flex-col font-sans text-gray-200" style="
    background-color: #141516; 
    background-image: url('data:image/svg+xml,%3Csvg width=%22100%22 height=%22100%22 viewBox=%220 0 100 100%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M10 10 Q 50 0 90 10 Q 100 50 90 90 Q 50 100 10 90 Q 0 50 10 10%22 fill=%22none%22 stroke=%22%231e293b%22 stroke-width=%222%22/%3E%3C/svg%3E'); 
    background-size: 100px 100px;
">

    <x-header />

    <main class="flex-grow flex items-center justify-center px-4">
        <div class="max-w-md w-full p-8 bg-slate-800 rounded-xl shadow-lg border border-slate-700">
            <h2 class="text-2xl text-white font-bold mb-6 text-center">Вход в систему</h2>
            
            @if ($errors->any()) 
                <div class="bg-red-900/50 border border-red-700 text-red-300 p-3 rounded-lg mb-4 text-sm">
                    {{ $errors->first() }}
                </div> 
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Логин</label>
                    <input type="text" name="login" class="w-full bg-slate-900 border border-slate-600 rounded-md p-2 text-white focus:outline-none focus:border-indigo-500" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Пароль</label>
                    <input type="password" name="password" class="w-full bg-slate-900 border border-slate-600 rounded-md p-2 text-white focus:outline-none focus:border-indigo-500" required>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-500 transition shadow-md">
                    Войти
                </button>
            </form>
            
            <div class="mt-6 text-center text-sm text-gray-400">
                Нет аккаунта? <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300">Зарегистрироваться</a>
            </div>
        </div>
    </main>

    <x-footer />

</body>
</html>