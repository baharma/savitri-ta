<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

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
        if (! $request->expectsJson()) {
            if (auth()->check()) {
                $userRole = auth()->user()->role->role;
                if ($userRole === 'admin' || $userRole === 'pemilik') {
                    return redirect('/');
                } else {
                    return redirect('/laporan');
                }
            } else {
                return route('login');
            }
        }
    }
}
