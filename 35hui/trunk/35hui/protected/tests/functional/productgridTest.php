<?php

class productgridTest extends WebTestCase
{
	public $fixtures=array(
		'productgrids'=>'productgrid',
	);

	public function testShow()
	{
		$this->open('?r=productgrid/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=productgrid/create');
	}

	public function testUpdate()
	{
		$this->open('?r=productgrid/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=productgrid/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=productgrid/index');
	}

	public function testAdmin()
	{
		$this->open('?r=productgrid/admin');
	}
}
