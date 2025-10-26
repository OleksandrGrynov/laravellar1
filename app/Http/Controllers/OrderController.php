<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /** 🧾 Список усіх замовлень для адмінки */
    public function index()
    {
        $orders = Order::latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /** 🔍 Перегляд одного замовлення */
    public function show(Order $order)
    {
        $order->load('items.animal', 'user');
        return view('admin.orders.show', compact('order'));
    }

    /** 👤 Замовлення конкретного користувача */
    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);
        return view('orders.mine', compact('orders'));
    }

    /** 🟢 Зміна статусу (оплата / відправка / виконано) */
    public function setStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:new,paid,shipped,done,canceled'
        ]);

        $order->update($data);
        return back()->with('status', '✅ Статус оновлено!');
    }

    /** 🛒 Сторінка оформлення */
    public function create()
    {
        $cart = session('cart', []);

        // ✅ замінено qty → quantity
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        abort_if(empty($cart), 302, '', ['Location' => route('cart.index')]);

        return view('cart.checkout', compact('cart', 'total'));
    }

    /** 💾 Створення замовлення */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_phone' => 'required|string|max:50',
            'customer_email' => 'nullable|email',
            'note'           => 'nullable|string',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        // ✅ замінено qty → quantity
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        // створюємо замовлення
        $order = Order::create([
            'user_id'        => Auth::id(),
            'customer_name'  => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'customer_email' => $data['customer_email'] ?? null,
            'note'           => $data['note'] ?? null,
            'total'          => $total,
            'status'         => 'new',
        ]);

        // створюємо позиції замовлення
        foreach ($cart as $id => $row) {
            OrderItem::create([
                'order_id'  => $order->id,
                'animal_id' => $id,
                'qty'       => $row['quantity'], // ✅ тепер кількість правильна
                'price'     => $row['price'],
            ]);
        }

        // очищаємо кошик
        session()->forget('cart');
        $data = $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_phone' => ['required', 'regex:/^\+380\d{9}$/'],
            'customer_email' => 'nullable|email|max:255',
            'note'           => 'nullable|string|max:1000',
        ]);

        return redirect()->route('thankyou')->with('status', '✅ Замовлення оформлено!');
    }
}
