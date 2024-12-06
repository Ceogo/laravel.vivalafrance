<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index($gtin)
    {
        $product = Product::where('GTIN', $gtin)->first();

        if (!$product || $product->is_hidden) {
            abort(404);
        }

        $company = $product->company;
        return view('card', compact('product', 'gtin', 'company'));
    }
}
