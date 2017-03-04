<?php

class logTest extends WebTestCase
{
	public $fixtures=array(
		'logs'=>'log',
	);

	public function testShow()
	{
		$this->open('?r=log/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=log/create');
	}

	public function testUpdate()
	{
		$this->open('?r=log/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=log/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=log/index');
	}

	public function testAdmin()
	{
		$this->open('?r=log/admin');
	}
}
