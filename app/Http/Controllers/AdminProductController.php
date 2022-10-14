<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Return_;

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
    public function store(Request $request)
    {
        $input = $request -> validate([
            'name' => 'string|required',
            'price' => 'string|required',
            'stock' => 'integer|nullable',
            'cover' => 'file|nullable',
            'description' => 'string|nullable',
        ]);
        $input['slug'] = Str::slug($input['name']);

        // Método para substituir local do arquivo por um caminho
        if (!empty($input['cover']) && $input['cover']->isValid()) {
            $file = $input['cover'];
            $path = $file->store('public/products');
            $input['cover'] = $path;
        }

        Product::create($input);

        Return Redirect::route('admin.product');
    }
}