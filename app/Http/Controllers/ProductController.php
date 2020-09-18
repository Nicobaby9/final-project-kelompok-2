<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'roles:0'])->except('index');
    }

    public function index()
    {
        return Product::with('category')->orderBy('name')->get();
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Product::create($data);
    }

    public function show(Product $prod)
    {
        return $prod;
    }

    public function update(Request $request, Product $prod)
    {
        $data = $request->all();
        $prod->update($data);
    }

    public function destroy(Product $prod)
    {
        $prod->delete();
    }
}
