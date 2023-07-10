<?php
namespace Marketplace;

use Exception;

class RestClient
{
    protected $curl = null;
    protected $base_url = "";

    public function __construct($base_url)
    {
        $this->base_url = $base_url;
        $this->curl = new CurlWrapper();
    }

    protected function setHeaders($custom)
    {
        $default_header = [
            'Content-Type' => 'application/json',
            'User-Agent' => 'Sellyd SDK'
        ];

        $default_header['Authorization'] = 'Bearer ' . SDK::getAccessToken();

        if (is_array($custom)) {
            $default_header = array_merge($default_header, $custom);
        }

        foreach ($default_header as $key => $val) {
            $headers[] = $key . ':' . $val;
        }

        return $this->curl->SetOpt(CURLOPT_HTTPHEADER, $headers);
    }

    protected function setData($data)
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
            return $this->curl->SetOpt(CURLOPT_POSTFIELDS, $data);
        }

	return false;
    }

    protected function getArrayValue($array, $key)
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        } else {
            return false;
        }
    }

    protected function exec($method, $opts)
    {
        $method = key($opts);
        $reqPath = reset($opts);
        $verb = self::$verbList[$method];

        $headers = $this->getArrayValue($opts, "headers");
	$query = $this->getArrayValue($opts, "query");
	$jsonData = $this->getArrayValue($opts, "json_data");

	if (!is_array($headers)) {
		throw new Exception("invalid option headers, expected array");
	}

	if (!is_string($query)) {
		throw new Exception("invalid option query, expected string");
	}

	if (!is_object($jsonData)) {
		throw new Exception("invalid option json_data, expected object");
	}

	$uri = $this->base_url . $query;
	$valid = $this->curl->SetOpt(CURLOPT_URL, $uri);
	if (!$valid) {
		throw new Exception("error on setting CURLOPT_URL");
	}

	$valid = $this->curl->SetOpt(CURLOPT_RETURNTRANSFER, true);
	if (!$valid) {
		throw new Exception("error on setting CURLOPT_RETURNTRANSFER");
	}

	$valid = $this->curl->SetOpt(CURLOPT_CUSTOMREQUEST, $method);
	if (!$valid) {
		throw new Exception("error on setting CURLOPT_CUSTOMREQUEST");
	}

	$valid = $this->setHeaders($headers);
	if (!$valid) {
		throw new Exception("error on setting CURL_HTTPHEADER");
	}

	$valid = $this->setData($jsonData);
	if (!$valid) {
		throw new Exception("error on setting CURL_POSTFIELDS");
	}

	$res = $this->curl->Exec();
	$resCode = $this->curl->GetInfo(CURLINFO_HTTP_CODE);

	if ($res === false) {
		throw new Exception($this->curl->Error());
	}

	$resData = json_decode($res, true);

	return [
	"code" => $resCode,
	"body" => $resData
	];
    }
}
