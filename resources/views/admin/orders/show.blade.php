@extends('layouts.app')
@section('title','Замовлення #'.$order->id)
@section('content')
    <div class="max-w-4xl mx-auto space-y-4">
        <div class="bg-white p-4 rounded shadow">
            <div class="font-bold mb-2">Інфо</div>
            <div>Клієнт: {{ $order->customer_name }} ({{ $order->customer_phone }})</div>
            <div>Email: {{ $order->customer_email ?? '—' }}</div>
            <div>Сума: <b>{{ number_format($order->total,2) }} ₴</b></div>
            <div>Статус: <b>{{ $order->status }}</b></div>
            <form class="mt-3" method="POST" action="{{ route('admin.orders.status',$order) }}">
                @csrf @method('PATCH')
                <select name="status" class="border rounded p-2">
                    @foreach(['new','paid','shipped','done','canceled'] as $s)
                        <option value="{{ $s }}" @selected($order->status==$s)>{{ $s }}</option>
                    @endforeach
                </select>
                <button class="btn btn-blue ml-2">Змінити</button>
            </form>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <div class="font-bold mb-2">Позиції</div>
            @foreach($order->items as $it)
                <div class="flex justify-between border-t py-2">
                    <div>{{ $it->animal->name ?? 'Товар видалено' }}</div>
                    <div>x{{ $it->qty }}</div>
                    <div>{{ number_format($it->price,2) }} ₴</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
