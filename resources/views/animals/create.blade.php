@extends('layouts.app')

@section('title', 'Додати тварину')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Додати нову тварину 🐾</h1>

        @if (session('status'))
            <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('admin.animals.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Назва</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Вид</label>
                <input type="text" name="species" value="{{ old('species') }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Вік</label>
                <input type="number" name="age" value="{{ old('age') }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Ціна (₴)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Опис</label>
                <textarea name="description" rows="4"
                          class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                          required>{{ old('description') }}</textarea>
            </div>

            @php($cats = \App\Models\Category::orderBy('name')->get())
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Категорія</label>
                <select name="category_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">— Не вказано —</option>
                    @foreach($cats as $c)
                        <option value="{{ $c->id }}" @selected(old('category_id', $animal->category_id ?? null) == $c->id)>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Фото</label>
                <input type="file" name="image"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    💾 Зберегти
                </button>
            </div>
        </form>
    </div>
@endsection
