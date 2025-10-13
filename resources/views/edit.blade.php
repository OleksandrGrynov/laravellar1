@extends('layouts.app')

@section('title','Редагувати новину')

@section('content')
    <form action="{{ route('news.update',$news) }}" method="post">
        @csrf
        @method('PUT')
        <label>Заголовок</label>
        <input type="text" name="title" value="{{ $news->title }}" required>

        <label>Текст</label>
        <textarea name="content" required>{{ $news->content }}</textarea>

        <button>Оновити</button>
    </form>
@endsection
