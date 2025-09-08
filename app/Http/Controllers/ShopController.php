<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View { return view('shop.index'); }
    public function cart(): View { return view('shop.cart'); }
    public function product(string $sku): View { return view('shop.product', compact('sku')); }
}
