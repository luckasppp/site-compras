<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{   // Aqui coloca os métodos do controller:
    public function index(Request $request)
    {
        $products = Product::query();   // Método pra startar a query no laravel

        // Método que fica difícil de entender
        // $products = Product::where('name', 'like', '%' . $request->search . '%')->get();    // Método pra ler todos os produtos do banco de dados
        
        // Método mais fácil de entender
        $products->when($request->search, function($query, $vl) {
           $query->where('name', 'like', '%' . $vl . '%')->get();
        });

        $products = $products->get();

        return view('home', [
            'products' => $products,
        ]);
    }
}
