<?php

class buyproductTest extends WebTestCase
{
	public $fixtures=array(
		'buyproducts'=>'buyproduct',
	);

	public function testShow()
	{
		$this->open('?r=buyproduct/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=buyproduct/create');
	}

	public function testUpdate()
	{
		$this->open('?r=buyproduct/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=buyproduct/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=buyproduct/index');
	}

	public function testAdmin()
	{
		$this->open('?r=buyproduct/admin');
	}
}
