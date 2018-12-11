<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use IanLChapman\PigLatinTranslator\Parser;
use App\Book;
use App\Author;

class PracticeController extends Controller
{
    public function practice16()
    {
        $books = Book::with('tags')->get();

        foreach ($books as $book) {
            dump($book->title.' is tagged with: ');
            foreach ($book->tags as $tag) {
                dump($tag->name.' ');
            }
        }

    }


    public function practice15()
    {
        $book = Book::where('title', '=', 'The Great Gatsby')->first();

        dump($book->title.' is tagged with: ');
        foreach ($book->tags as $tag) {
            dump($tag->name);
        }
    }


    public function practice14()
    {
        #If you're querying for many books, you may want to join in the related author
        # data with that query.
        # This can be done via the with method and is referred to as eager loading

        # Eager load the author with the book
        $books = Book::with('author')->get();

        foreach ($books as $book) {
            dump($book->author->first_name . ' ' . $book->author->last_name . ' wrote ' . $book->title);
        }

        dump($books->toArray());

    }


    public function practice13()
    {
# Get the first book as an example
        $book = Book::first();

# Get the author from this book using the "author" dynamic property
# "author" corresponds to the the relationship method defined in the Book model
        $author = $book->author;

# Output
        dump($book->title.' was written by '.$author->first_name.' '.$author->last_name);
        dump($book->toArray());    }


    public function practice12()
    {
        #Here's an example where we create a book, and then associate that book with an author.
        $author = Author::where('first_name', '=', 'J.K.')->first();

        $book = new Book;
        $book->title = "Fantastic Beasts and Where to Find Them";
        $book->published_year = 2017;
        $book->cover_url = 'http://prodimage.images-bn.com/pimages/9781338132311_p0_v2_s192x300.jpg';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/fantastic-beasts-and-where-to-find-them-j-k-rowling/1004478855';
        $book->author()->associate($author); # <--- Associate the author with this book
        $book->save();
        dump($book->toArray());

    }


    public function practice11()
    {
        $results = Book::where('author', '=', 'J.K. Rowling')->delete();
        dump($results);
    }


    public function practice10()
    {
        $results = Book::where('author', '=', 'JK Rowling')->update(['author' => 'J.K. Rowling']);
        dump($results);

    }


    public function practice9()
    {
        $results = Book::orderBy('published_year', 'desc')->get();

        if ($results->isEmpty()) {
            dump('No matches found');
        } else {
            foreach ($results as $book) {
                dump($book->title, $book->published_year);
            }
        }
    }

    public function practice8()
    {
        $results = Book::orderBy('title')->get();

        if ($results->isEmpty()) {
            dump('No matches found');
        } else {
            foreach ($results as $book) {
                dump($book->title);
            }
        }
    }


    public function practice7()
    {
        $results = Book::where('published_year', '>', '1950')->get();

        if ($results->isEmpty()) {
            dump('No matches found');
        } else {
            foreach ($results as $book) {
                dump($book->title);
            }
        }
    }

    public function practice6()
    {
        $results = Book::orderBy('created_at', 'desc')->limit(2)->get();

        if ($results->isEmpty()) {
            dump('No matches found');
        } else {
            foreach ($results as $book) {
                dump($book->title);
            }
        }
    }


    public function practice5()
    {
        $book = new Book();
        $books = $book->where('title', 'LIKE', '%Harry Potter%')->get();

        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            foreach ($books as $book) {
                dump($book->title);
            }
        }
    }

    public function practice4()
    {
        # Instantiate a new Book Model object
        $book = new Book();

        # Set the properties
        # Note how each property corresponds to a field in the table
        $book->title = 'Harry Potter and the Sorcerer\'s Stone';
        $book->author = 'J.K. Rowling';
        $book->published_year = 1997;
        $book->cover_url = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        dump('Added: ' . $book->title);
    }

    /**
     * Demonstrating using an external package
     */
    public function practice3()
    {
        $translator = new Parser();
        $translation = $translator->translate('Hello World');
        dump($translation);
    }

    /*
     * Demonstrating getting values from configs
     */
    public function practice2()
    {
        dump(config('mail.supportEmail'));
        # Disabling this line to prevent accidentally revealing mail related credentials on the prod. server
        //dump(config('mail'));
    }

    /**
     * Demonstrating the first practice example
     */
    public function practice1()
    {
        dump('This is the first example.');
    }

    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://foobooks.loc/practice => Shows a listing of all practice routes
     * http://foobooks.loc/practice/1 => Invokes practice1
     * http://foobooks.loc/practice/5 => Invokes practice5
     * http://foobooks.loc/practice/999 => 404 not found
     */
    public function index($n = null)
    {
        $methods = [];
        # If no specific practice is specified, show index of all available methods
        if (is_null($n)) {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }
            # Load the view and pass it the array of methods
            dump($methods);
            return view('practice')->with(['methods' => $methods]);
        } # Otherwise, load the requested method
        else {
            $method = 'practice' . $n;
            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method() : abort(404);
        }
    }


}