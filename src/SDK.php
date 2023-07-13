<?php

namespace Sellyd;

class SDK
{
	protected static $restClient;
	protected static $apiKey;

	/*
	 * @return void
	 */
	public function init() : void
	{
		self::$restClient = new RestClient();
	}

	/*
	 * @param $key string
	 * @return void
	 */
	public static function setApiKey(string $key) : void
	{
		self::$apiKey = $key;
	}

	/*
	 * @return string
	 */
	public static function getApiKey() : string
	{
		return self::$apiKey;
	}

	/*
	 * @return RestClient
	 */
	public static function getRestClient() : RestClient
	{
		return self::$restClient;
	}
}
