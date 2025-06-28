<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index()
    {
        $user = Auth::user();
        $articles = Article::with('category')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('articles.index', compact('articles', 'user'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'nullable|string|unique:articles,slug',
            'excerpt'      => 'nullable|string',
            'content'      => 'required|string',
            'category_id'  => 'nullable|exists:categories,id',
            'thumbnail'    => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->only([
            'title',
            'excerpt',
            'content',
            'category_id',
            'published_at',
        ]);

        $data['user_id'] = Auth::id();
        $data['slug'] = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->title . '-' . Str::random(5));

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Article::create($data);

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'nullable|string|unique:articles,slug,' . $article->id,
            'excerpt'      => 'nullable|string',
            'content'      => 'required|string',
            'category_id'  => 'nullable|exists:categories,id',
            'thumbnail'    => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->only([
            'title',
            'excerpt',
            'content',
            'category_id',
            'published_at',
        ]);

        $data['slug'] = $request->slug
            ? Str::slug($request->slug)
            : $article->slug;

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $article->update($data);

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
