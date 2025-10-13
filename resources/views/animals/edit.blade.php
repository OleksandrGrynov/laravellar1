@extends('layouts.app')

@section('title','Редагувати новину')

@section('content')
    <form action="{{ route('news.update',$news) }}" method="post">
        @csrf
        @if(!empty($animal->image))
            <img src="{{ asset('storage/'.$animal->image) }}" class="w-40 h-40 object-cover rounded mb-2">
        @endif

        @method('PUT')
        <label>Заголовок</label>
        <input type="text" name="title" value="{{ $news->title }}" required>

        <label>Текст</label>
        <textarea name="content" required>{{ $news->content }}</textarea>

        <button>Оновити</button>
    </form>
    @php($cats = \App\Models\Category::orderBy('name')->get())

    <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Категорія</label>
        <select name="category_id" class="w-full border-gray-300 rounded-md">
            <option value="">— Не вказано —</option>
            @foreach($cats as $c)
                <option value="{{ $c->id }}" @selected(old('category_id', $animal->category_id ?? null)==$c->id)>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
    </div>

@endsection
