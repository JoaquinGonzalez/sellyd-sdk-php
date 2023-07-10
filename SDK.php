<?php

namespace Sellyd;

define("SDK_API_KEY_OPT_NAME", "SDK_API_KEY");

class SDK
{
	protected static $restClient;
	protected static $apiKey;

	public function init()
	{
		self::$restClient = new RestClient();

		self::$apiKey = get_option(SDK_API_KEY_OPT_NAME);
	}

	public static function setApiKey($key)
	{
		self::$apiKey = $key;

		update_option(SDK_API_KEY_OPT_NAME, self::$apiKey);
	}

	public static function getAccessToken() {
		return self::$apiKey;
	}
}
