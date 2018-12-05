<div class='book'>
    <h3>{{ $book->title }}</h3>
    <h4>by {{ $book->author }}</h4>
    <img src='{{ $book->cover_url }}' alt='Cover image for the book {{ $book->title }}'><br>
    <a href='/books/{{$book->id}}'>View</a>&nbsp;|&nbsp;
    <a href='/books/{{$book->id}}/edit'>Edit</a>&nbsp;|&nbsp;
    <a href='/books/{{$book->id}}/delete'>Delete</a>

</div>
