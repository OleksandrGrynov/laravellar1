@extends('layouts.app')
@section('title','Мої замовлення')
@section('content')
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Мої замовлення</h1>
        @forelse($orders as $o)
            <a href="{{ route('admin.orders.show',$o) }}" class="block bg-white p-4 rounded shadow mb-3">
                <div class="flex justify-between">
                    <div>#{{ $o->id }} • {{ $o->created_at->format('d.m.Y H:i') }}</div>
                    <div>{{ number_format($o->total,2) }} ₴ • {{ $o->status }}</div>
                </div>
            </a>
        @empty
            <p class="text-gray-500">Замовлень поки немає.</p>
        @endforelse
        <div class="mt-3">{{ $orders->links() }}</div>
    </div>
@endsection
