@extends('layouts.app')
@section('title','Замовлення')
@section('content')
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Замовлення</h1>
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr><th class="p-2 text-left">#</th><th class="p-2">Клієнт</th><th class="p-2">Сума</th><th class="p-2">Статус</th><th class="p-2"></th></tr>
                </thead>
                <tbody>
                @foreach($orders as $o)
                    <tr class="border-t">
                        <td class="p-2">{{ $o->id }}</td>
                        <td class="p-2">{{ $o->customer_name }} ({{ $o->customer_phone }})</td>
                        <td class="p-2 font-semibold">{{ number_format($o->total,2) }} ₴</td>
                        <td class="p-2">{{ $o->status }}</td>
                        <td class="p-2"><a class="text-blue-600" href="{{ route('admin.orders.show',$o) }}">Деталі</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $orders->links() }}</div>
    </div>
@endsection
