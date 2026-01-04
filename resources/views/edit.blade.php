@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm relative">
    
    {{-- 削除ボタン --}}
    <div class="absolute top-8 right-8">
        <form action="{{ route('destroy', $post) }}" method="POST" onsubmit="return confirm('本当にこのログを削除しますか？\n（画像も削除されます）');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold">削除する</button>
        </form>
    </div>

    <h1 class="text-2xl font-bold mb-6 text-slate-700">ログの編集</h1>
    
    <form action="{{ route('update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-5">
            <label class="block text-slate-700 font-bold mb-2 text-sm">日付</label>
            <input type="date" name="date" value="{{ $post->date->format('Y-m-d') }}" class="w-full bg-slate-50 border border-slate-300 p-3 rounded" required>
        </div>

        <div class="mb-5">
            <label class="block text-slate-700 font-bold mb-2 text-sm">タイトル</label>
            <input type="text" name="title" value="{{ $post->title }}" class="w-full bg-slate-50 border border-slate-300 p-3 rounded" required>
        </div>

        <div class="mb-5">
            <label class="block text-slate-700 font-bold mb-2 text-sm">タグ</label>
            <input type="text" name="tags" value="{{ $currentTags }}" list="tag-list" class="w-full bg-slate-50 border border-slate-300 p-3 rounded" autocomplete="off">
            <datalist id="tag-list">
                @foreach($allTags as $tag)
                    <option value="{{ $tag->name }}">
                @endforeach
            </datalist>
        </div>

        <div class="mb-5">
            <label class="block text-slate-700 font-bold mb-2 text-sm">画像</label>
            @if($post->image_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="h-32 rounded object-cover">
                    <p class="text-xs text-slate-500 mt-1">※新しい画像をアップロードすると上書きされます</p>
                </div>
            @endif
            <input type="file" name="image" class="w-full text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*">
        </div>

        <div class="mb-8">
            <label class="block text-slate-700 font-bold mb-2 text-sm">内容</label>
            <textarea name="body" rows="6" class="w-full bg-slate-50 border border-slate-300 p-3 rounded">{{ $post->body }}</textarea>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition duration-300">更新する</button>
    </form>
</div>
@endsection