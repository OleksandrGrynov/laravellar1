<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private string $key = 'cart';

    /** Показ кошика */
    public function index()
    {
        $cart = session($this->key, []);

        // 🔹 Додаємо перевірку, якщо quantity відсутня (старі дані)
        foreach ($cart as &$item) {
            if (!isset($item['quantity'])) {
                $item['quantity'] = 1;
            }
        }

        // 🔹 Обчислення загальної суми
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        session([$this->key => $cart]); // оновимо виправлені дані в сесії

        return view('cart.index', compact('cart', 'total'));
    }

    /** Додавання до кошика */
    public function add(Request $request, Animal $animal)
    {
        $cart = session()->get($this->key, []);

        $quantity = (int) $request->input('quantity', 1);
        if ($quantity < 1) $quantity = 1;

        if (isset($cart[$animal->id])) {
            $cart[$animal->id]['quantity'] += $quantity;
        } else {
            $cart[$animal->id] = [
                'id' => $animal->id,
                'name' => $animal->name,
                'price' => $animal->price,
                'quantity' => $quantity,
                'image' => $animal->image,
            ];
        }

        session()->put($this->key, $cart);

        return redirect()
            ->route('cart.index')
            ->with('status', "✅ Додано {$quantity} × {$animal->name}");
    }

    /** Оновлення кількості */
    public function update(Request $request, $id)
    {
        $cart = session()->get($this->key, []);

        if (isset($cart[$id])) {
            $quantity = (int) $request->input('quantity', 1);
            if ($quantity < 1) $quantity = 1;

            $cart[$id]['quantity'] = $quantity;
            session()->put($this->key, $cart);
        }

        return redirect()->route('cart.index')->with('status', '✅ Кількість оновлено');
    }

    /** Видалити позицію */
    public function remove(Animal $animal)
    {
        $cart = session($this->key, []);
        unset($cart[$animal->id]);
        session([$this->key => $cart]);

        return back()->with('status', '❌ Товар видалено');
    }

    /** Очистити весь кошик */
    public function clear()
    {
        session()->forget($this->key);
        return back()->with('status', '🧹 Кошик очищено');
    }
    public function ajaxUpdate(Request $request)
    {
        $id = (int) $request->input('id');
        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($quantity < 1) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = $quantity;
            }
            session()->put('cart', $cart);
        }

        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        return response()->json([
            'ok' => true,
            'id' => $id,
            'itemTotal' => isset($cart[$id]) ? number_format($cart[$id]['price'] * $cart[$id]['quantity'], 2, '.', ' ') : 0,
            'total' => number_format($total, 2, '.', ' '),
            'count' => count($cart)
        ]);
    }

}
