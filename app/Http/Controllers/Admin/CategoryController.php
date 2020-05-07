<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private const PAGINATE_LIMIT = 10;
    private const PARENT_CATEGORY_ID = 0;

    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::paginate(self::PAGINATE_LIMIT),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create', [
            'category' => [],
            'categories' => Category::with('children')
                ->where('parent_id', self::PARENT_CATEGORY_ID)
                ->get(),
            'delimiter' => ''
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Category::create($request->all());

        return redirect()->route('admin.category.index');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category,
            'categories' => Category::with('children')
                ->where('parent_id', self::PARENT_CATEGORY_ID)
                ->get(),
            'delimiter' => '',
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->update($request->except('slug'));

        return redirect()->route('admin.category.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.category.index');
    }
}
