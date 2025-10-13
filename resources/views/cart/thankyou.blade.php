@extends('layouts.app')
@section('title','Дякуємо!')
@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow text-center">
        <h1 class="text-2xl font-bold mb-2">🎉 Дякуємо за замовлення!</h1>
        <p class="text-gray-600">Ми зв'яжемося з вами найближчим часом.</p>
        <a href="{{ route('animals.index') }}" class="btn btn-blue mt-4">Повернутись до каталогу</a>
    </div>
@endsection
