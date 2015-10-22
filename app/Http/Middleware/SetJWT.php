<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class SetJWT
 * @package App\Http\Middleware3
 *
 * JWT middleware is responsible for hitting the server API,
 * send the credentials that the user used to login
 * and retrieve the token (if the credentials are correct) after postLogin method
 * of the default Laravel authentication system.
 * After getting the token, we set a cookie at the browser that contains the JWT
 * in order to easily retrieve it at each API request.
 *
 */
class SetJWT {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $response = $next($request);

        $baseUrl = "http://city-r-us-service/api/v1/users/login";

        $email = Auth::user()->email;
        $password = $request->password;

        // Get cURL resource
        $curl = curl_init();

        // Set some options, such as the url
        // And also set the method to POST
        curl_setopt_array($curl, [
            CURLOPT_URL => $baseUrl . '?email=' . $email . '&password=' . $password,
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => true,
           // CURLOPT_NOBODY => false

        ]);

        // Send the request & save response to $resp
        $resp = curl_exec($curl);


        // Close request to clear up some resources
        curl_close($curl);

        $cookie = \Cookie::make('jwtToken', json_decode($resp)->data->token);


        return $response->withCookie($cookie);
    }

}
