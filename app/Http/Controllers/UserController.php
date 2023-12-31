<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Method to handle form submissions and register the user
    public function register(Request $request)
    {
        // Validation rules for user registration
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];

        $validatedData = $request->validate($rules);

        // Store the validated user data in the database
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'user', // Assign 'user' role by default
        ]);

        auth()->login($user);
        return redirect('/login');
    }

    public function showProfile($userId)
    {
        $user = User::findOrFail($userId);
        $borrowedBooks = $user->borrows; // Assuming you have a relation named borrowedBooks
        $borrowedBooks = $user->borrows()->with('book')->get();
        return view('profile', compact('user', 'borrowedBooks'));
    }
}
