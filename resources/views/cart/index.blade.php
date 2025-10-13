@extends('layouts.app')
@section('title','Кошик')
@section('content')
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">🛒 Кошик</h1>

        @if(empty($cart))
            <p class="text-gray-600">Кошик порожній.</p>
        @else
            <div class="space-y-3">
                @foreach($cart as $item)
                    <div class="bg-white p-4 rounded shadow flex items-center gap-4">
                        @if($item['image'])
                            <img src="{{ asset('storage/'.$item['image']) }}" class="w-20 h-20 object-cover rounded">
                        @endif
                        <div class="flex-1">
                            <div class="font-semibold">{{ $item['name'] }}</div>
                            <div class="text-sm text-gray-500">{{ $item['species'] }}</div>
                        </div>
                        <div class="font-semibold">{{ number_format($item['price'],2) }} ₴</div>
                        <form action="{{ route('cart.remove',$item['id']) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-red">✖</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between items-center mt-6">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-red">Очистити</button>
                </form>
                <div class="text-xl font-bold">Разом: {{ number_format($total,2) }} ₴</div>
            </div>

            <div class="mt-4 text-right">
                <a href="{{ route('checkout') }}" class="btn btn-blue">Оформити замовлення</a>
            </div>
        @endif
    </div>
@endsection
