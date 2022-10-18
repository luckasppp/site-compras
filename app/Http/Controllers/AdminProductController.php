<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
    public function edit(Product $product)
    {
        return view('admin.product_edit', [
            'product' => $product
        ]);
    }

    // Recebe requisição para dar update
    public function update(Product $product, ProductStoreRequest $request)
    {
        $input = $request -> validate();

        if (!empty($input['cover']) && $input['cover']->isValid()) {
            Storage::delete($product->cover ?? ''); // Comando que exclui registros anteriores da imagem
            $file = $input['cover'];
            $path = $file->store('public/products');
            $input['cover'] = $path;
        }

        $product->fill($input);
        $product->save();

        Return Redirect::route('admin.product');
    }

    // Mostrar página de criar
    public function create()
    {
        return view('admin.product_create');
    }

    // Recebe a requisição de criar
    public function store(ProductStoreRequest $request)
    {
        $input = $request -> validate();
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

    public function destroy(Product $product)
    {
        $product->delete();
        Storage::delete($product->cover ?? ''); // Comando que exclui registros anteriores da imagem
        
        return Redirect::route('admin.product');
    }

    public function destroyImage(Product $product)
    {
        Storage::delete($product->cover ?? '');
        $product->cover = null;
        $product->save();

        return Redirect::back();
         
    }
}