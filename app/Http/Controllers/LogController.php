<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogController extends Controller
{
    // 一覧画面
    public function index()
    {
        $posts = Post::with('tags')->orderBy('date', 'desc')->get();
        return view('index', compact('posts'));
    }

    // 画像ギャラリー
    public function gallery()
    {
        $posts = Post::whereNotNull('image_path')->orderBy('date', 'desc')->get();
        return view('gallery', compact('posts'));
    }

    // 新規作成フォーム
    public function create()
    {
        $allTags = Tag::all(); // 入力補助用
        return view('create', compact('allTags'));
    }

    // 保存処理
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|image|max:10240', // 10MBまで
            'tags' => 'nullable|string',
        ]);

        $post = new Post($validated);

        // 画像保存 (storage/app/public/uploads へ)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $post->image_path = $path;
        }

        $post->save();
        $this->syncTags($post, $request->tags);

        return redirect()->route('index')->with('success', 'ログを記録しました。');
    }

    // 編集画面
    public function edit(Post $post)
    {
        $allTags = Tag::all();
        // タグ配列をカンマ区切り文字列に変換
        $currentTags = $post->tags->pluck('name')->implode(',');
        return view('edit', compact('post', 'allTags', 'currentTags'));
    }

    // 更新処理
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|image|max:10240',
            'tags' => 'nullable|string',
        ]);

        $post->fill($validated);

        if ($request->hasFile('image')) {
            // 古い画像を削除
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $path = $request->file('image')->store('uploads', 'public');
            $post->image_path = $path;
        }

        $post->save();
        $this->syncTags($post, $request->tags);

        return redirect()->route('index')->with('success', 'ログを更新しました。');
    }

    // 削除処理
    public function destroy(Post $post)
    {
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();
        return redirect()->route('index')->with('success', 'ログを削除しました。');
    }

    // タグ保存用の共通メソッド
    private function syncTags(Post $post, ?string $tagsInput)
    {
        if (!$tagsInput) {
            $post->tags()->detach();
            return;
        }

        // 全角カンマ対応と空白除去
        $tagNames = array_map('trim', explode(',', str_replace('、', ',', $tagsInput)));
        $tagIds = [];

        foreach ($tagNames as $name) {
            if (empty($name)) continue;
            // タグがあれば取得、なければ作成
            $tag = Tag::firstOrCreate(['name' => $name]);
            $tagIds[] = $tag->id;
        }

        $post->tags()->sync($tagIds);
    }
}