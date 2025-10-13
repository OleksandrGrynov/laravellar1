<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.animal','user'])->latest()->paginate(10);
        return view('admin.dashboard', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:new,paid,shipped,done,canceled',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('status', '✅ Статус оновлено!');
    }
}
