@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm">
    <h1 class="text-2xl font-bold mb-6 text-slate-700">新しいログを記録</h1>
    
    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-5">
            <label class="block text-slate-700 font-bold mb-2 text-sm">日付</label>
            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full bg-slate-50 border border-slate-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div class="mb-5">
            <label class="block text-slate-700 font-bold mb-2 text-sm">タイトル</label>
            <input type="text" name="title" class="w-full bg-slate-50 border border-slate-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="今日の課題や出来事" required>
        </div>

        <div class="mb-5">
            <label class="block text-slate-700 font-bold mb-2 text-sm">タグ（課題など）</label>
            <p class="text-xs text-slate-500 mb-2">カンマ( , )区切りで複数入力。過去のタグは候補に出ます。</p>
            <input type="text" name="tags" list="tag-list" class="w-full bg-slate-50 border border-slate-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Laravel, 学習, エラー解決" autocomplete="off">
            <datalist id="tag-list">
                @foreach($allTags as $tag)
                    <option value="{{ $tag->name }}">
                @endforeach
            </datalist>
        </div>

        <div class="mb-5">
            <label class="block text-slate-700 font-bold mb-2 text-sm">画像</label>
            <input type="file" name="image" class="w-full text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*">
        </div>

        <div class="mb-8">
            <label class="block text-slate-700 font-bold mb-2 text-sm">内容</label>
            <textarea name="body" rows="6" class="w-full bg-slate-50 border border-slate-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition duration-300">保存する</button>
    </form>
</div>
@endsection