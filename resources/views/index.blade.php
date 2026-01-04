@extends('layout')

@section('content')
<div class="space-y-6">
    @foreach($posts as $post)
    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-200">
        <div class="flex flex-col md:flex-row gap-6">
            {{-- 画像がある場合のみ表示 --}}
            @if($post->image_path)
            <div class="w-full md:w-1/3 shrink-0">
                <img src="{{ asset('storage/' . $post->image_path) }}" class="rounded-lg object-cover w-full h-48 md:h-full cursor-pointer hover:opacity-90">
            </div>
            @endif

            <div class="flex-1">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-slate-500 text-sm font-mono bg-slate-100 px-2 py-1 rounded">{{ $post->date->format('Y-m-d') }}</span>
                    <a href="{{ route('edit', $post) }}" class="text-slate-400 hover:text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>
                </div>
                
                <h2 class="text-xl font-bold mb-3 text-slate-800">{{ $post->title }}</h2>
                
                <div class="mb-4 flex flex-wrap gap-2">
                    @foreach($post->tags as $tag)
                        <span class="bg-indigo-50 text-indigo-600 text-xs px-2 py-1 rounded-full font-medium">#{{ $tag->name }}</span>
                    @endforeach
                </div>
                
                <p class="whitespace-pre-wrap text-slate-600 leading-relaxed">{{ $post->body }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection