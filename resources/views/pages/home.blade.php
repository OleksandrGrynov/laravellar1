@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto text-center py-20">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">🐾 Ласкаво просимо до нашого магазину тварин!</h1>
        <p class="text-lg text-gray-600 mb-8">Тут ви можете переглядати, додавати й купувати тварин.</p>
        <a href="{{ route('animals.index') }}" class="px-6 py-3 bg-blue-600 text-black rounded-lg hover:bg-blue-700">
            Переглянути каталог
        </a>
    </div>
@endsection
