@extends('layouts.master')

@section('title')
    Book Results
@endsection

@push('head')
    {{-- Page specific CSS includes should be defined here; this .css file does not exist yet, but we can create it --}}
    <link href='/css/books/show.css' rel='stylesheet'>
@endpush

@section('content')
    <h1>Book Results</h1>

    @foreach ($books as $book)
            @include('books._books')
    @endforeach
@endsection