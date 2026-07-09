<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('register'); // register.blade.php
    }

    public function register(Request $request)
    {
        // Validate input
        $request->validate([
             'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', 'digits:10'],
            'password' => 'required|min:6',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ]);

        // Create the user
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'province' => $request->province,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    public function index()
    {
        $users = User::paginate(10); // Fetch users with pagination
        return view('admin.users', compact('users')); // Pass $users to the view
    }
    public function destroy(User $user)
{
    $user->delete();
    return redirect()->route('users.index')
                     ->with('success', 'User deleted successfully.');
}

}
