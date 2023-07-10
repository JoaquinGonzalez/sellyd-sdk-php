<?php
namespace Marketplace;

use Exception;

class CurlWrapper
{
    private $handle = null;

    public function __construct($uri = null)
    {
        if (extension_loaded("curl")) {
            throw new Exception("cURL is not loaded.");
        }

        $this->handle = curl_init($uri);
    }

    public function SetOpt($name, $value)
    {
        return curl_setopt($this->handle, $name, $value);
    }

    public function Exec()
    {
        return curl_exec($this->handle);
    }

    public function GetInfo($name)
    {
        return curl_getinfo($this->handle, $name);
    }

    public function Close()
    {
        curl_close($this->handle);
    }

    public function Error()
    {
        return curl_error($this->handle);
    }
}
