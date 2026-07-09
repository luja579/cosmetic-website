<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ($request->expectsJson()) {
            return null; // For API requests, return null
        }

        // Check if the request is for admin routes
        if ($request->is('admin') || $request->is('admin/*')) {
            return route('admin.login'); // Redirect to admin login
        }

        // Default redirect for non-admin routes
        return route('login');
    }
}