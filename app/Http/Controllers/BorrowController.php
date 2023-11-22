<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;

class BorrowController extends Controller
{
    public function borrowBook(Request $request, $bookId)
{
    $book = Book::findOrFail($bookId);

    // Check if the book is available for borrowing
    if ($book->available_copies > 0) {
        $user = $request->user(); // Assuming user authentication is set up

        // Check if the user can borrow more books
        if (!$user->canBorrowBooks()) {
            return redirect()->back()->with('error', 'You have reached the maximum limit of borrowed books.');
        }

        // Create a borrow entry
        $borrow = Borrow::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrow_date' => now(), // Set the borrow date
            'return_date' => null, // Return date initially set to null
        ]);

        // Update available copies of the book
        $book->available_copies--;

        // Save changes to the book
        $book->save();

        // Check if the borrow entry was created successfully
        if ($borrow) {
            return redirect()->back()->with('success', 'Book borrowed successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create a borrow entry.');
        }
    } else {
        return redirect()->back()->with('error', 'Book not available for borrowing.');
    }
}

    public function returnBook(Request $request, $borrowId)
    {
        $borrow = Borrow::findOrFail($borrowId);
        $book = $borrow->book;

        // Check if the book is already returned
        if ($borrow->return_date !== null) {
            return redirect()->back()->with('error', 'This book has already been returned.');
        }

        // Update the return date and increment available copies
        $borrow->return_date = now();
        $book->available_copies++;

        // Save changes
        $borrow->save();
        $book->save();

        return redirect()->back()->with('success', 'Book returned successfully!');
    }
}
