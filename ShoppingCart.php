<?php
class ShoppingCart
{	
	private $products = null;

	public function setProduct(Product $product)
	{
		$this->products[] = $product;
	}

	public function getProducts()
	{
		return $this->products;
	}
}

class Product
{
	protected $shop = null;
	protected $price = null;

	function __construct($shopId, $price)
	{
		if (empty($shopId))
		{
			throw new Exception("invalid shopId", 1);	
		}
		else if (!is_int($price))
		{
			throw new Exception("invalid price", 1);
		}

		$this->shopId = $shopId;
		$this->price = $price;
	}
}

class book extends Product
{
	private $isbn = null;
	function __construct($shopId, $price, $isbn)
	{
		parent::__construct($shopId, $price);

		if (!$this->isIsbn($isbn))
		{
			throw new Exception("invalid isbn", 1);	
		}

		$this->isbn = $isbn;
	}

	public function isIsbn($isbn)
	{
		$isIsbn = false;
		if (preg_match('/^(\d{9}(?:\d|X))$/', $isbn) ||
			preg_match('/^(\d{12}(?:\d|X))$/', $isbn))
		{
			$isIsbn = true;
		}
		return $isIsbn;
	}
}

$shoppingCart = new ShoppingCart();

$book1 = new book('F013798407', 2025, '9781491936085');
if ($book1 instanceof Product) {
	$shoppingCart->setProduct($book1);
}

$book2 = new book('F013653365', 1350, '9781491933091');
if ($book2 instanceof Product) {
	$shoppingCart->setProduct($book2);
}

$products = $shoppingCart->getProducts();

var_dump($products);

