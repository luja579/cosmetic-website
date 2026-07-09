<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', ['user' => auth()->user()]); // creates resources/views/dashboard.blade.php
    }
   
}
