<?php
namespace Marketplace;

use Exception;

class RestClient
{
    protected $curl = null;
    protected $base_url = "";

    protected static $verbList = [
        'get' => 'GET',
        'post' => 'POST'
    ];

    public function __construct($base_url)
    {
        $this->base_url = $base_url;
        $this->curl = new CurlWrapper();
    }

    protected function SetHeaders($custom)
    {
        $default_header = [
            'Content-Type' => 'application/json',
            'User-Agent' => 'Marketplace SDK'
        ];

        $default_header['Authorization'] = 'Bearer ' . SDK::getAccessToken(); // AQUI FALTA EL ACCESS TOKEN

        if (is_array($custom)) {
            $default_header = array_merge($default_header, $custom);
        }

        foreach ($default_header as $key => $val) {
            $headers[] = $key . ':' . $val;
        }

        $this->curl->SetOpt(CURLOPT_HTTPHEADER, $headers);
    }

    protected function setData(Http\HttpRequest $conn, $data)
    {
        if (gettype($data) == "string") {
            json_decode($data, true);
        } else {
            $data = json_encode($data);
        }

        if (function_exists('json_last_error')) {
            $json_error = json_last_error();

            if ($json_error != JSON_ERROR_NONE) {
                throw new Exception("JSON Error {{$json_error}] - Data: {$data}");
            }
        }

        if ($data != "[]") {
            $conn->setOption(CURLOPT_POSTFIELDS, $data);
        }
    }

    protected function getArrayValue($array, $key)
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        } else {
            return false;
        }
    }

    protected function exec($opts)
    {
        $method = key($opts);
        $reqPath = reset($opts);
        $verb = self::$verbList[$method];

        $headers = 
    }
}
