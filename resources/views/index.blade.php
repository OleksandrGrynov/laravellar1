@extends('layouts.app')

@section('title','Каталог тварин')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">🐾 Каталог тварин</h1>
            <a href="{{ route('animals.create') }}" class="btn btn-blue">➕ Додати тварину</a>
        </div>

        @if($animals->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($animals as $animal)
                    <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-xl transition">
                        @if($animal->image)
                            <img src="{{ asset('storage/' . $animal->image) }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h2 class="text-lg font-bold">{{ $animal->name }}</h2>
                            <p class="text-gray-600">{{ $animal->species }} • {{ $animal->age }} р.</p>
                            <p class="text-green-600 font-semibold mt-2">{{ $animal->price }} ₴</p>
                            <a href="{{ route('animals.show', $animal) }}" class="text-blue-600 text-sm">Детальніше →</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">{{ $animals->links() }}</div>
        @else
            <p class="text-gray-500">Каталог поки порожній 🐶</p>
        @endif
    </div>
@endsection
