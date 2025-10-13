@extends('layouts.app')
@section('title','Додати тварину')
@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-xl font-bold mb-4">➕ Додати тварину</h1>
        <form action="{{ route('animals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Назва тварини" class="w-full border rounded p-2" required>
            <input type="text" name="species" placeholder="Вид (кіт, собака...)" class="w-full border rounded p-2" required>
            <input type="number" name="age" placeholder="Вік" class="w-full border rounded p-2" required>
            <input type="number" step="0.01" name="price" placeholder="Ціна ₴" class="w-full border rounded p-2" required>
            <textarea name="description" rows="4" placeholder="Опис" class="w-full border rounded p-2" required></textarea>
            <input type="file" name="image" class="w-full border rounded p-2">
            <button type="submit" class="btn btn-blue">💾 Зберегти</button>
        </form>
    </div>
@endsection
