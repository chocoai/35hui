<?php

class regionTest extends WebTestCase
{
	public $fixtures=array(
		'regions'=>'region',
	);

	public function testShow()
	{
		$this->open('?r=region/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=region/create');
	}

	public function testUpdate()
	{
		$this->open('?r=region/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=region/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=region/index');
	}

	public function testAdmin()
	{
		$this->open('?r=region/admin');
	}
}
