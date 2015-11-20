<?php namespace App\Services;

/**
 * This class wraps the curl functionality in order to reuse code.
 *
 * Class Curl
 * @package App\Services
 */
class Curl {

    private $baseUrl = "";

    function __construct()
    {
        $this->baseUrl = env("API_URL");
    }


    public function get($url, $params) {

        // Get cURL resource
        $curl = curl_init();

        // Set some options, such as the url
        // And also set the method to POST
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->baseUrl . $url . '?' . $this->stringify($params),
            CURLOPT_POST => 0,
            CURLOPT_RETURNTRANSFER => true

        ]);

        // Send the request & save response to $resp
        $response = curl_exec($curl);

        // Close request to clear up some resources
        curl_close($curl);
        return json_decode($response);

    }

    public function post($url, $params, $headers = null) {
        // Get cURL resource
        $curl = curl_init();

        // Set some options, such as the url
        // And also set the method to POST
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->baseUrl . $url,
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $this->stringify($params)
        ]);

        if ($headers != null)
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // Send the request & save response to $resp
        $response = curl_exec($curl);

        // Close request to clear up some resources
        curl_close($curl);

        return json_decode($response);
    }


    /**
     * Make a string of params from a given array
     *
     * @param $array
     * @return string
     */
    private function stringify($array) {
        $string = '';
        foreach ($array as $key => $value) {
            $string .= $key . '=' . $value . '&';
        }

        return $string;
    }
}
