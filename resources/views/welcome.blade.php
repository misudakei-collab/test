<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center bg-white p-10 rounded-xl shadow-lg">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Welcome</h1>
        
        <div class="space-y-4 flex flex-col">
            <a href="{{ route('contact.selection') }}" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-500 transition">
                お問い合わせ画面へ
            </a>

            <div class="flex justify-center space-x-4 mt-6 border-t pt-6">
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 underline">ログイン</a>
                <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 underline">新規登録</a>
            </div>
        </div>
    </div>
</body>
</html>