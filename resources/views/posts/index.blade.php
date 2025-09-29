@extends('layouts.app')

@section('title', $title ?? 'Список постів')

@section('content')
    <h2>{{ $title }}</h2>

    @foreach($posts as $post)
        <x-post-card :title="$post['title']"
                     :excerpt="$post['excerpt']"
                     :author="$post['author']"
                     :date="$post['date']"/>
    @endforeach
@endsection
