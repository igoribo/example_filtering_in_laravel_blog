<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Requests\StoreArticleRequest;
use App\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with(['categories', 'tags', 'author'])
            ->when(request('categories'), function($query) {
                return $query->whereHas('categories', function($q) {
                    return $q->whereIn('id', request('categories'));
                });
            })
            ->when(request('tags'), function($query) {
                return $query->whereHas('tags', function($q) {
                    return $q->whereIn('id', request('tags'));
                });
            })
            ->when(request('query'), function($query) {
                return $query->where('title', 'like', '%'.request('query').'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(3);
        $all_categories = Category::all();
        $all_tags = Tag::all();
        return view('articles.index', compact('articles', 'all_categories', 'all_tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('articles.create', compact('categories'));
    }

    /**
     * @param StoreArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreArticleRequest $request)
    {
        $article = Article::create($request->all() + ['user_id' => auth()->id()]);

        if (isset($request->category_id)) {
            $article->categories()->attach($request->category_id);
        }

        if ($request->tags != '') {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag_name) {
                $tag = Tag::firstOrCreate(['name' => $tag_name]);
                $article->tags()->attach($tag);
            }
        }

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->load(['categories', 'tags', 'author']);
        $all_categories = Category::all();
        $all_tags = Tag::all();

        return view('articles.show', compact('article', 'all_categories', 'all_tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
