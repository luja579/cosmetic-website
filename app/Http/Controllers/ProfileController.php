<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
{
    return view('profile.index');
}
public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email,' . auth()->id(),
            'phone'      => 'nullable|digits:10',
            // 'password' => 'required|min:6',
            'province'   => 'nullable|string|max:100',
            'city'       => 'nullable|string|max:100',
            'postal_code'=> 'nullable|string|max:10',
        ]);
        
        auth()->user()->update($data);

        return redirect()->route('dashboard')->with('success','Profile updated.');
    }
    public function show()
{
    $user = auth()->user();

    // Load orders related to this user
    $orders = \App\Models\Order::where('user_id', $user->id)->get();

    return view('profile.show', compact('user', 'orders'));
}

}
