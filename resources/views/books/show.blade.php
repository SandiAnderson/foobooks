@extends('layouts.master')

@section('title')
    {{ $title }}
@endsection

@push('head')
    {{-- Page specific CSS includes should be defined here; this .css file does not exist yet, but we can create it --}}
    <link href='/css/books/show.css' rel='stylesheet'>
@endpush

@section('content')
    <h1>{{ $title }}</h1>

    <p>
    @foreach ($books as $book)
        <div class='book'>
            <h3>{{ $title }}</h3>
            <h4>by {{ $book['author'] }}</h4>
            <img src='{{ $book['cover_url'] }}' alt='Cover image for the book {{ $title }}'>
        </div>
        @endforeach
        </p>
@endsection