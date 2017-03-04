<?php

class buycomboTest extends WebTestCase
{
	public $fixtures=array(
		'buycombos'=>'buycombo',
	);

	public function testShow()
	{
		$this->open('?r=buycombo/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=buycombo/create');
	}

	public function testUpdate()
	{
		$this->open('?r=buycombo/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=buycombo/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=buycombo/index');
	}

	public function testAdmin()
	{
		$this->open('?r=buycombo/admin');
	}
}
