<?php namespace App\Services;

class JWTService {


    public function setCookie() {

        $baseUrl = env("API_URL")."/users/authenticate";

        $email = \Auth::user()->email;
        $password = \Request::get('password');

        // Get cURL resource
        $curl = curl_init();

        // Set some options, such as the url
        // And also set the method to POST
        curl_setopt_array($curl, [CURLOPT_URL => $baseUrl . '?email=' . $email . '&password=' . $password,
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => true,// CURLOPT_NOBODY => false

        ]);

        // Send the request & save response to $resp
        $resp = curl_exec($curl);


        // Close request to clear up some resources
        curl_close($curl);

        if (json_decode($resp) != null)
          setcookie("jwtToken", json_decode($resp)->message->token, time() + 7200, '/');
         $cookie = \Cookie::make('jwtToken', json_decode($resp)->message->token, null, null, null, false, false);

        return;
    }


    public function unsetCookie() {
        setcookie("jwtToken", null, null,  '/');
        return;
    }

}
