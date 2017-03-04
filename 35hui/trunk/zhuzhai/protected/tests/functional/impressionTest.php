<?php

class impressionTest extends WebTestCase
{
	public $fixtures=array(
		'impressions'=>'impression',
	);

	public function testShow()
	{
		$this->open('?r=impression/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=impression/create');
	}

	public function testUpdate()
	{
		$this->open('?r=impression/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=impression/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=impression/index');
	}

	public function testAdmin()
	{
		$this->open('?r=impression/admin');
	}
}
