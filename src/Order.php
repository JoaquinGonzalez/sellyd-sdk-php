<?php
/*
 * Order.php
 * Copyright (c) 2023 Joaquin Gonzalez <joaquin@sellyd.com>
 * @license GPL V3
 */

namespace Sellyd;

class Order
{
	protected string $id;
	protected string $status;
	protected array  $items;

	/*
	 * @return void
	 */
	public function post() : void
	{
	}

	/*
	 * @param $product Product
	 * @return void
	 */
	public function addItem(Product $product) : void
	{
		$this->items[] = $product;
	}
}
