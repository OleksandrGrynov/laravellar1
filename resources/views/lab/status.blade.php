@extends('layouts.app')

@section('title', 'Lab Status')

@section('content')
    <h2>Status</h2>
    <p>Стан: {{ $status }}</p>
@endsection
