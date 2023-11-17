<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureClientSpecificPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        $user = Auth::user();
        $clientId = $user->client_id; // Or however you retrieve the current client_id

        if (!$user->hasClientSpecificPermission($permission, $clientId)) {
            // Redirect or abort depending on your preference
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
