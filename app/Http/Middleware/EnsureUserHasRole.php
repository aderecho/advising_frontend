<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $allowed = collect($roles)->map(fn (string $role) => UserRole::from($role));

        if (! $allowed->contains($user->role)) {
            abort(403, 'You do not have access to this area.');
        }

        return $next($request);
    }
}
