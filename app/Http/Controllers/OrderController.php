<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index() {
        $orders = \App\Models\Order::latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }
    public function show(\App\Models\Order $order) {
        $order->load('items.animal','user');
        return view('admin.orders.show', compact('order'));
    }
    public function myOrders() {
        $orders = \App\Models\Order::where('user_id', auth()->id())->latest()->paginate(10);
        return view('orders.mine', compact('orders'));
    }

    public function setStatus(Request $r, \App\Models\Order $order) {
        $data = $r->validate(['status'=>'required|in:new,paid,shipped,done,canceled']);
        $order->update($data);
        return back()->with('status','Статус оновлено ✅');
    }

    public function create()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn ($i) => $i['price'] * $i['qty']);
        abort_if(empty($cart), 302, '', ['Location' => route('cart.index')]);
        return view('cart.checkout', compact('cart','total'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_phone' => 'required|string|max:50',
            'customer_email' => 'nullable|email',
            'note'           => 'nullable|string',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('cart.index');

        $total = collect($cart)->sum(fn ($i) => $i['price'] * $i['qty']);

        $order = Order::create([
            'user_id'        => Auth::id(),
            'customer_name'  => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'customer_email' => $data['customer_email'] ?? null,
            'note'           => $data['note'] ?? null,
            'total'          => $total,
            'status'         => 'new',
        ]);

        foreach ($cart as $row) {
            OrderItem::create([
                'order_id'  => $order->id,
                'animal_id' => $row['id'],
                'qty'       => $row['qty'],
                'price'     => $row['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('thankyou')->with('status', 'Замовлення оформлено!');
    }
}

