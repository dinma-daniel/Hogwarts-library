<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function borrowBook(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);

        $user = Auth::user();

        if (!$user->canBorrowBooks()) {
            return redirect()->back()->with('error', 'You have reached the maximum limit of borrowed books.');
        }
        if ($user->hasBorrowedBook($bookId)) {
            return redirect()->back()->with('error', 'You have already borrowed this book.');
        }
        $borrow = Borrow::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrow_date' => now(),
            'return_date' => null,
        ]);


        if ($borrow) {
            return redirect()->back()->with('success', 'Book borrowed successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create a borrow entry.');
        }
    }

    public function returnBook($borrowId)
    {
        $borrow = Borrow::findOrFail($borrowId);

        if ($borrow->return_date !== null) {
            return redirect()->back()->with('error', 'This book has already been returned.');
        }

        $borrow->return_date = now();
        $borrow->save();

        return redirect()->back()->with('success', 'Book returned successfully!');
    }
}
