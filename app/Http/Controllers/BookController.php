<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all(); // Retrieve all books from the database using the Book model

        return view('books.index', ['books' => $books]);
    }
    public function show($id)
{
    $book = Book::findOrFail($id);
    return view('books.show', ['book' => $book]);
}
}
