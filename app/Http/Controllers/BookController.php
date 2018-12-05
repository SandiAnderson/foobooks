<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    //
    public function index()
    {
        $books = Book::orderBy('title')->get();

        return view('books.index')->with([
            'books' => $books
        ]);
    }

    public function show($id)
    {
        $books = Book::where('id', 'LIKE', $id)->get();
        return view('books.index')->with([
            'books' => $books]);
    }

    /**
     * GET
     * /books/search
     * Show the form to search for a book
     */
    public function search(Request $request)
    {
        return view('books.search')->with([
            'searchTerm' => $request->session()->get('searchTerm', ''),
            'caseSensitive' => $request->session()->get('caseSensitive', false),
            'searchResults' => $request->session()->get('searchResults', []),
        ]);
    }

    /**
     * GET
     * /books/search-process
     * Process the form to search for a book
     */
    public function searchProcess(Request $request)
    {
        $searchTerm = '%'.$request->searchTerm.'%';
        $searchResults = Book::where('title', 'LIKE', $searchTerm)->get();
        # Redirect back to the search page w/ the searchTerm *and* searchResults (if any) stored in the session
        # Ref: https://laravel.com/docs/redirects#redirecting-with-flashed-session-data
        return redirect('/books/search')->with([
            'searchTerm' => $request->searchTerm,
            'caseSensitive' => $request->has('caseSensitive'),
            'searchResults' => $searchResults
        ]);
    }

    /**
     * GET /books/create
     * Display the form to add a new book
     */
    public function create(Request $request)
    {
        return view('books.create');
    }


    /**
     * POST /books
     * Process the form for adding a new book
     */
    public function store(Request $request)
    {
        # Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'bail|required|digits:4',
            'cover_url' => 'required|url',
            'purchase_url' => 'required|url'
        ]);

        # Note: If validation fails, it will redirect the visitor back to the form page
        # and none of the code that follows will execute.

        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->published_year = $request->input('published_year');
        $book->cover_url = $request->input('cover_url');
        $book->purchase_url = $request->input('purchase_url');
        $book->save();

        return redirect('/books/create')->with([
            'alert' => 'Your book was added.'
        ]);

    }

    public function edit($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return redirect('/books')->with([
                'alert' => 'Book not found.'
            ]);
        }

        return view('books.edit')->with([
            'book' => $book
        ]);
    }


    /*
    * PUT /books/{id}
    */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'required|digits:4|numeric',
            'cover_url' => 'required|url',
            'purchase_url' => 'required|url',
        ]);

        $book = Book::find($id);
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->published_year = $request->input('published_year');
        $book->cover_url = $request->input('cover_url');
        $book->purchase_url = $request->input('purchase_url');
        $book->save();

        return redirect('/books/' . $id . '/edit')->with([
            'alert' => 'Your changes were saved.'
        ]);
    }


    /*
     * method to delete
     *
     */
    public function checkdelete($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return redirect('/books')->with([
                'alert' => 'Book not found.'
            ]);
        }

        return view('books.delete')->with([
            'book' => $book
        ]);
    }


    /*
    * DELETE /books/{id}
    */
    public function delete(Request $request, $id)
    {

        $book = Book::find($id);
        if (!$book) {
            return redirect('/books')->with([
                'alert' => 'Book not found.'
            ]);
        }

        $book->delete();

        return redirect('/books')->with([
            'alert' => 'Your book was deleted.'
        ]);
    }

}
