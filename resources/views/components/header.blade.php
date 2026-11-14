<header class="bg-slate-800 shadow-lg border-b border-slate-700">
    <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Логотип -->
        <a href="/" class="text-2xl font-bold text-indigo-400 hover:text-indigo-300 transition">
            QuizMaster
        </a>

        <!-- Навигация -->
        <nav class="flex items-center space-x-6">
            <a href="/quizzes" class="text-gray-300 hover:text-white transition">Все тесты</a>
            
            @auth
                <!-- Если юзер залогинен -->
                <a href="/quizzes/create" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition shadow-md">
                    + Создать тест
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-red-400 transition">
                        Выйти ({{ Auth::user()->login }})
                    </button>
                </form>
            @else
                <!-- Если не залогинен -->
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition">Вход</a>
                <a href="{{ route('register') }}" class="text-gray-300 hover:text-white transition">Регистрация</a>
            @endauth
        </nav>
    </div>
</header>