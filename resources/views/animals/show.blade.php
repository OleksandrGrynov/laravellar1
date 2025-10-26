@extends('layouts.app')

@section('title', $animal->name)

@section('content')
    {{-- Підключення тільки CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <div class="animal-page">
        <div class="animal-card-large">
            {{-- Фото --}}
            <div class="animal-photo">
                @if($animal->image)
                    <img src="{{ asset('storage/' . $animal->image) }}" alt="{{ $animal->name }}">
                @else
                    <div class="no-photo">📷 Без фото</div>
                @endif
            </div>

            {{-- Інформація --}}
            <div class="animal-info-block">
                <h1 class="animal-name">{{ $animal->name }}</h1>
                <p class="animal-species">{{ $animal->species }} • {{ $animal->age }} р.</p>
                <p class="animal-desc">{{ $animal->description }}</p>

                <div class="animal-buy">
                    <p class="animal-price">{{ number_format($animal->price, 0, ',', ' ') }} ₴</p>

                    <form action="{{ route('cart.add', $animal) }}" method="POST" class="animal-form">
                        @csrf
                        <label for="quantity">Кількість:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="10">
                        <button type="submit" class="btn cart">🛒 Додати в кошик</button>
                    </form>
                </div>

                <a href="{{ route('animals.index') }}" class="btn back">⬅ Назад до каталогу</a>
            </div>
        </div>
    </div>
@endsection
