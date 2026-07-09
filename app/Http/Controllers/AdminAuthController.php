<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.index');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
    public function logout(Request $request)
    {
    Auth::guard('admin')->logout(); // logout from admin guard

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login'); // Redirect to admin login page
    }
    
}
