<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{   // Aqui coloca os métodos do controller:
    public function index()
    {
        $products  = Product::all();    // Método pra ler todos os produtos do banco de dados
        return view('home', [
            'products' => $products,
        ]);
    }
}
