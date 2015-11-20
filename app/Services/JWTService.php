<?php namespace App\Services;

/**
 * Service that handles all JWT cookie operations
 *
 * Class JWTService
 * @package App\Services
 */
class JWTService {


    /**
     * Retrieve the JWT cookie
     *
     * @return null
     */
    public function getCookie() {
        //check if the JWT cookie is set
        if (!isset($_COOKIE['jwtToken']) || $_COOKIE['jwtToken'] == null || $_COOKIE['jwtToken'] == '') {
           \Auth::logout();
            \Session::flush();
            return 'logout';
        }
        else
            $jwt = $_COOKIE['jwtToken'];

        return $jwt;
    }

    /**
     * For a logged in user, set the JWT cookie
     *
     * @param null $encrypted
     * @return null
     */
    public function setCookie($encrypted = null) {

        $baseUrl = env("API_URL") . "/users/authenticate";

            $email = \Auth::user()->email;
            $password = \Request::get('password');
            if ($password == null || $password == '')
                $password = \Auth::user()->password;

            // Get cURL resource
            $curl = curl_init();

            // Set some options, such as the url
            // And also set the method to POST
            curl_setopt_array($curl, [CURLOPT_URL => $baseUrl . '?email=' . $email . '&password=' . $password . '&encrypted=' . $encrypted,
                CURLOPT_POST => 1,
                CURLOPT_RETURNTRANSFER => true
            ]);

            // Send the request & save response to $resp
            $resp = curl_exec($curl);

            // Close request to clear up some resources
            curl_close($curl);

            $response = json_decode($resp);
            $jwt = null;

            if ($response != null && $response->status != 'error') {
                $jwt = $response->message->token;
                setcookie("jwtToken", $jwt, time() + 60*60*24*365, '/');
                // $cookie = \Cookie::make('jwtToken', $response->message->token, null, null, null, false, false);
            }
            return $jwt;
    }

    /**
     * Remove the cookie from the browser (i.e when user logs out)
     */
    public function unsetCookie() {
        setcookie("jwtToken", null, null, '/');
        return;
    }

}
