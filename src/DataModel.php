<?php
/*
 * DataModel.php
 * Copyright (c) 2023 Joaquin Gonzalez <joaquin@sellyd.com>
 * @license GPL V3
 */

namespace Sellyd;

define("SELLYD_BASE_URL", "https://sellyd.com/api/v1");

class DataModel
{
	private static $instance;
	private static RestClient $rc;

	public function __construct()
	{
		self::$rc = new RestClient(SELLYD_BASE_URL . self::getEndpoint());
		self::$instance = $this;
	}

	/*
	 * @return string
	 */
	private static function getEndpoint() : string
	{
		return "/" . strtolower(get_called_class()) . "s";
	}

	/*
	 * @return RestClient
	 */
	protected function getRestClient() : RestClient
	{
		return self::$rc;
	}

	/*
	 * @return array
	 */
	public static function getAttrs() : array
	{
		return get_object_vars(self::$instance);
	}
}
