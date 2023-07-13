<?php

namespace Sellyd;

use Exception;

class CurlWrapper
{
	private $handle = null;

	public function __construct(string $uri = null)
	{
		if (extension_loaded("curl")) {
			throw new Exception("cURL is not loaded.");
		}

		$this->handle = curl_init($uri);
	}

	/*
	 * @param $name string
	 * @param $value mixed
	 * @return bool
	 */
	public function SetOpt(string $name, mixed $value) : bool
	{
		return curl_setopt($this->handle, $name, $value);
	}

	/*
	 * @return stirng|bool
	 */
	public function Exec() : string|bool
	{
		return curl_exec($this->handle);
	}

	/*
	 * @param $name string
	 * @return mixed
	 */
	public function GetInfo(string $name) : mixed
	{
		return curl_getinfo($this->handle, $name);
	}

	/*
	 * @return void
	 */
	public function Close() : void
	{
		curl_close($this->handle);
	}

	/*
	 * @return string
	 */
	public function Error() : string
	{
		return curl_error($this->handle);
	}
}
