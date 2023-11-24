<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

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
        $user = auth::user();
        return view('books.show', ['book' => $book, 'user' => $user]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $books = Book::where('title', 'like', $query . '%')->get();
        
        return response()->json($books);
    }

}
