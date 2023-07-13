<?php
/*
 * SDK.php
 * Copyright (c) 2023 Joaquin Gonzalez <joaquin@sellyd.com>
 * @license GPL V3
 */

namespace Sellyd;

class SDK
{
	protected static $apiKey;

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
}
