<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'roles:0']);
    }

    public function index()
    {
        return Category::orderBy('name')->get();
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Category::create($data);
    }

    public function show(Category $cat)
    {
        return $cat;
    }

    public function update(Request $request, Category $cat)
    {
        $data = $request->all();
        $cat->update($data);
    }

    public function destroy(Category $cat)
    {
        $prods = Product::where('category_id', $cat->id)->get();

        foreach ($prods as $prod) {
            $prod->delete();
        }

        $cat->delete();
    }
}
