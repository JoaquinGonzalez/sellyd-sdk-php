<?php
/*
 * Product.php
 * Copyright (c) 2023 Joaquin Gonzalez <joaquin@sellyd.com>
 * @license GPL V3
 */

namespace Sellyd;

class Product extends DataModel
{
	protected string $id;
	protected int    $stock;

	/*
	 * @return bool
	 */
	public function getById() : bool
	{
		$rc = $this->getRestClient();

		return $rc->get([
			"query" => "/",
			"json_data" => [
				"id" => $this->id
			]
		]);
	}

	/*
	 * @return bool
	 */
	public function get() : bool
	{
	}

	/*
	 * @return bool
	 */
	public function inStock() : bool
	{
	}

	/*
	 * @param $id string
	 * @return void
	 */
	public function setId(string $id) : void
	{
		$this->id = $id;
	}

	/*
	 * @param @stock int
	 * @return void
	 */
	public function setStock(int $stock) : void
	{
		$this->stock = $stock;
	}
}
