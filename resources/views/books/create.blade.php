@extends('layouts.master')

@section('title')
    Add a book
@endsection

@section('content')
    <h1>Add a book</h1>

    <form method='POST' action='/books'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}

        <label for='title'>* Title</label>
        <input type='text' name='title' id='title' value='{{old('title', 'Fire and Blood')}}'>
        @include('modules.field-error',['field'=>'title'])

        <label for='author_id'>* Author</label>
        <label for='author_id'>* Author</label>
        <select name='author_id'>
            <option value=''>Choose one...</option>
            @foreach($authors as $author)
                <option value='{{ $author->id }}' {{ (old('author_id') == $author->id) ? 'selected' : '' }}>{{ $author->first_name.' '.$author->last_name }}</option>
            @endforeach
        </select>
        @include('modules.field-error',['field'=>'author_id'])

        <label for='published_year'>* Published Year (YYYY)</label>
        <input type='text' name='published_year' id='published_year' value='{{old('published_year', '2018')}}'>
        @include('modules.field-error',['field'=>'published_year'])

        <label for='cover_url'>* Cover URL</label>
        <input type='text' name='cover_url' id='cover_url'
               value='{{old('cover_url','https://prodimage.images-bn.com/pimages/9781524796280_p0_v2_s550x406.jpg')}}'>
        @include('modules.field-error',['field'=>'cover_url'])

        <label for=' purchase_url'>* Purchase URL </label>
        <input type='text' name='purchase_url' id='purchase_url'
               value='{{old('purchase_url','https://www.barnesandnoble.com/w/fire-blood-george-r-r-martin/1128905006?ean=9781524796280#/')}}'>
        @include('modules.field-error',['field'=>'purchase_url'])

        <label>Tags</label>
        <ul class='checkboxes'>
            @foreach($tags as $tagId => $tagName)
                <li><label><input
                                {{ (in_array($tagId, old('tags', []) )) ? 'checked' : '' }}
                                type='checkbox'
                                name='tags[]'
                                value='{{ $tagId }}'> {{ $tagName }}</label></li>
            @endforeach
        </ul>

        <input type='submit' value='Add book'>
    </form>
    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection
