<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

/**
 * Class UnsetJWT
 * @package App\Http\Middleware

 *
 */
class UnsetJWT {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $response = $next($request);

        $cookie = Cookie::forget('jwtToken');

        return $response->withCookie($cookie);
    }

}
