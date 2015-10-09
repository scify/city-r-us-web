<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class JWT {

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
            CURLOPT_POST => 1
        ]);

        // Send the request & save response to $resp
        $resp = curl_exec($curl);

        //dd('aaa');

        // Close request to clear up some resources
        curl_close($curl);

        setcookie("jwtToken", 'aaa', time()+3600, '/');
        
        return $response;
    }

}
