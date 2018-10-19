<?php
/*
 * Home
 */
Route::get('/', 'WelcomeController@index');
/**
 * Books
 */
Route::get('/books/{title}', 'BookController@show');
Route::get('/books', 'BookController@index');
/**
 * Practice
 */
Route::any('/practice/{n?}', 'PracticeController@index');

