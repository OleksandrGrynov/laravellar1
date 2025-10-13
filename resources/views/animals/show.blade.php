@extends('layouts.app')
@section('title', $animal->name)
@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
        @if($animal->image)
            <img src="{{ asset('storage/' . $animal->image) }}" class="w-full h-64 object-cover rounded mb-4">
        @endif
        <h1 class="text-2xl font-bold">{{ $animal->name }}</h1>
        <p class="text-gray-600">Вид: {{ $animal->species }}</p>
        <p>Вік: {{ $animal->age }} років</p>
        <p class="text-green-600 text-xl font-semibold mt-2">Ціна: {{ $animal->price }} ₴</p>
            <form action="{{ route('cart.add', $animal) }}" method="POST" class="mt-4">
                @csrf
                <button class="btn btn-blue">Додати в кошик</button>
            </form>

            <p class="mt-4">{{ $animal->description }}</p>

        <div class="flex gap-3 mt-6">
            <a href="{{ route('animals.edit', $animal) }}" class="btn btn-yellow">✏️ Редагувати</a>
            <form action="{{ route('animals.destroy', $animal) }}" method="POST">
                @csrf @method('DELETE')
                <button class="btn btn-red">🗑 Видалити</button>
            </form>
        </div>
    </div>
@endsection
