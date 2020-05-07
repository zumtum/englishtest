<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ArticleController extends Controller
{
    private const PAGINATE_LIMIT = 10;
    private const PARENT_CATEGORY_ID = 0;

    public function index(): View
    {
        return view('admin.articles.index', [
            'articles' => Article::orderBy('created_at', 'desc')->paginate(self::PAGINATE_LIMIT),
        ]);
    }

    public function create(): View
    {
        return view('admin.articles.create', [
            'article' => [],
            'categories' => Category::with('children')
                ->where('parent_id', self::PARENT_CATEGORY_ID)
                ->get(),
            'delimiter' => '',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $article = Article::create($request->all());

        if ($request->input('categories')) {
            $article->categories()->attach($request->input('categories'));
        }

        return redirect()->route('admin.article.index');
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.edit', [
            'article' => $article,
            'categories' => Category::with('children')
                ->where('parent_id', self::PARENT_CATEGORY_ID)
                ->get(),
            'delimiter' => '',
        ]);
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $article->update($request->except('slug'));

        $article->categories()->detach();
        if ($request->input('categories')) {
            $article->categories()->attach($request->input('categories'));
        }

        return redirect()->route('admin.article.index');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->categories()->detach();
        $article->delete();

        return redirect()->route('admin.article.index');

    }
}
