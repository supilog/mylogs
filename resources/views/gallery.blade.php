@extends('layout')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-slate-700">画像ギャラリー</h1>

@if($posts->isEmpty())
    <p class="text-slate-500">画像付きの投稿はまだありません。</p>
@else
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($posts as $post)
            <a href="{{ route('edit', $post) }}" class="group relative block overflow-hidden rounded-lg aspect-square">
                <img src="{{ asset('storage/' . $post->image_path) }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition duration-300 flex items-end">
                    <p class="text-white text-sm p-3 opacity-0 group-hover:opacity-100 truncate w-full font-bold">
                        {{ $post->date->format('Y-m-d') }}<br>
                        {{ $post->title }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
@endif
@endsection