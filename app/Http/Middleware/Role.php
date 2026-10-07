<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = auth()->user();

        foreach ($roles as $role) {
            $lolos = $role === 'Ketua KBK'
                ? $user->apakahKetuaKbk()
                : $user->role === $role;

            if ($lolos) {
                return $next($request);
            }
        }

        abort(403, 'Anda tidak memiliki hak mengakses laman tersebut!');
    }
}