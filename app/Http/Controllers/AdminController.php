<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;

class AdminController extends Controller
{
    public function manageBooks()
    {
        // Retrieve all books from the database
        $books = Book::all();

        return view('admin.manage_books', compact('books'));
    }

    public function viewBorrowedBooks()
    {
        // Retrieve all borrowed books with details
        $borrowedBooks = Borrow::with('book', 'user')->get();

        return view('admin.borrowed_books', compact('borrowedBooks'));
    }
    public function addBook(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'required|string',
            // Add other necessary validations for book details
        ]);
    
        // Create a new book using the validated data
        $book = Book::create([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'description' => $validatedData['description'],
            // Assign other fields as needed
        ]);
    
        // Redirect back with a success message or perform other actions
        return redirect()->back()->with('success', 'Book added successfully!');
    }
    
}
