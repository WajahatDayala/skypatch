<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    
    public function handle(Request $request, Closure $next,$roles): Response
    {
        $user = $request->user('admin');
        if (!$user || !in_array($user->role->name, $roles)) {
            return redirect('/'); // Redirect if unauthorized
        }


        return $next($request);
    }
}
