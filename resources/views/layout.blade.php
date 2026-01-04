<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mylogs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen">
    <nav class="bg-white shadow p-4 mb-6 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center max-w-4xl">
            <a href="{{ route('index') }}" class="text-xl font-bold text-indigo-600 tracking-wider">mylogs</a>
            <div class="space-x-4 text-sm font-medium">
                <a href="{{ route('index') }}" class="hover:text-indigo-500">タイムライン</a>
                <a href="{{ route('gallery') }}" class="hover:text-indigo-500">ギャラリー</a>
                <a href="{{ route('create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">新規記録</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 pb-12 max-w-4xl">
        @if(session('success'))
            <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        @yield('content')
    </div>
</body>
</html>