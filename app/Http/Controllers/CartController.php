<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private string $key = 'cart';

    public function index()
    {
        $cart = session($this->key, []);
        $total = collect($cart)->sum(fn ($i) => $i['price'] * $i['qty']);
        return view('cart.index', compact('cart','total'));
    }

    // Додаємо (для тварин логічно обмежити qty=1)
    public function add(Animal $animal, Request $request)
    {
        $cart = session($this->key, []);
        if (!isset($cart[$animal->id])) {
            $cart[$animal->id] = [
                'id' => $animal->id,
                'name' => $animal->name,
                'species' => $animal->species,
                'price' => (float)$animal->price,
                'image' => $animal->image,
                'qty' => 1,
            ];
        }
        session([$this->key => $cart]);
        return back()->with('status', 'Додано до кошика');
    }

    public function remove(Animal $animal)
    {
        $cart = session($this->key, []);
        unset($cart[$animal->id]);
        session([$this->key => $cart]);
        return back()->with('status', 'Видалено з кошика');
    }

    public function clear()
    {
        session()->forget($this->key);
        return back()->with('status', 'Кошик очищено');
    }
}
