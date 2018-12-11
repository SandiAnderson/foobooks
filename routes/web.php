<?php
/*
 * Home
 */
Route::get('/', 'WelcomeController');


/**
 * Books
 */
# Search for books

Route::get('/books/search', 'BookController@search');
Route::get('/books/search-process', 'BookController@searchProcess');

#Create Books
Route::get('/books/create', 'BookController@create');
Route::post('/books', 'BookController@store');

#Show Individual book
Route::get('/books/{id}', 'BookController@show');
#Show all books
Route::get('/books', 'BookController@index');

#Edit Books
Route::get('/books/{id}/edit', 'BookController@edit');
Route::put('/books/{id}', 'BookController@update');

#Delete Books
Route::get('/books/{id}/delete', 'BookController@checkdelete');
Route::delete('/books/{id}', 'BookController@delete');

/**
 * Practice
 */
Route::any('/practice/{n?}', 'PracticeController@index');


/*
 * Pages
 * Simple, static pages without a lot of logic
 */
Route::view('/about', 'about');
Route::view('/contact', 'contact');


Auth::routes();

