@extends('layouts.master')

@section('title')
    Add a book
@endsection

@section('content')
    <h1>Edit {{$book->title}}</h1>
    {{old('author_id')}}

    <form method='POST' action='/books/{{ $book->id }}'>
        <div class='details'>* Required fields</div>
        {{ method_field('put') }}
        {{ csrf_field() }}

        <label for='title'>* Title</label>
        <input type='text' name='title' id='title' value='{{$book->title}}'>
        @include('modules.field-error',['field'=>'title'])

        <label for='author_id'>* Author</label>
        <select name='author_id'>
            <option value=''>Choose one...</option>
            @foreach($authors as $author)
                <option value='{{ $author->id }}' {{ ($book->author_id == $author->id) ? 'selected' : '' }}>{{ $author->first_name.' '.$author->last_name }}</option>
            @endforeach
        </select>
        @include('modules.field-error', ['field' => 'author_id'])

        <label for='published_year'>* Published Year (YYYY)</label>
        <input type='text' name='published_year' id='published_year' value='{{$book->published_year}}'>
        @include('modules.field-error',['field'=>'published_year'])

        <label for='cover_url'>* Cover URL</label>
        <input type='text' name='cover_url' id='cover_url' value='{{$book->cover_url}}'>
        @include('modules.field-error',['field'=>'cover_url'])

        <label for=' purchase_url'>* Purchase URL </label>
        <input type='text' name='purchase_url' id='purchase_url' value='{{$book->purchase_url}}'>
        @include('modules.field-error',['field'=>'purchase_url'])

        @foreach($allTags as $tagId => $tagName)
            <ul class='tags'>
                <li>
                    <label>
                        <input
                                {{ (in_array($tagId, $tags)) ? 'checked' : '' }}
                                type='checkbox'
                                name='tags[]'
                                value='{{ $tagId }}'>
                        {{ $tagName }}
                    </label>
                </li>
            </ul>
        @endforeach

        <input type='submit' value='Edit this book'>

    </form>
    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection
