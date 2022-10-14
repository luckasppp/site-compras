<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    // Mostrar a página de editar produto
    public function edit()
    {
        $products = Product::all();
        return view('admin.product_edit');
    }

    // Recebe requisição para dar update
    public function update()
    {
        # code...
    }

    // Mostrar página de criar
    public function create()
    {
        return view('admin.product_create');
    }

    // Recebe a requisição de criar
    public function store()
    {
        # code...
    }
}