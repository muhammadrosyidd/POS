<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function category($type)
    {
        return view('product', ['category' => $type]);
    }
}
