@extends('layouts.app')
@section('title', 'Кошик')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <div class="cart-container">
        <h1 class="cart-title">🛒 Кошик</h1>

        @if(empty($cart))
            <p class="cart-empty">Кошик порожній 😿</p>
        @else
            <div class="cart-items">
                @foreach($cart as $id => $item)
                    <div class="cart-item">
                        @if(!empty($item['image']))
                            <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}">
                        @endif

                        <div class="cart-info">
                            <h3>{{ $item['name'] }}</h3>
                            <p>Ціна: {{ number_format($item['price'], 2) }} ₴</p>
                            <p>Сума: <strong>{{ number_format($item['price'] * $item['quantity'], 2) }} ₴</strong></p>
                        </div>

                        <form action="{{ route('cart.update', $id) }}" method="POST" class="cart-qty-form">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item['quantity'] ?? 1 }}" min="1" max="10">
                            <button type="submit" class="btn blue small">Оновити</button>
                        </form>

                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn red small">✖</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="cart-footer">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn red">Очистити кошик</button>
                </form>

                <div class="cart-total">
                    Разом: <strong>{{ number_format($total, 2) }} ₴</strong>
                </div>

                <a href="{{ route('checkout') }}" class="btn blue">Оформити замовлення</a>
            </div>
        @endif
    </div>

@endsection
