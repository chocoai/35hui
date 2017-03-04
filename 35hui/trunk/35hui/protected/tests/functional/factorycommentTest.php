<?php

class factorycommentTest extends WebTestCase
{
	public $fixtures=array(
		'factorycomments'=>'factorycomment',
	);

	public function testShow()
	{
		$this->open('?r=factorycomment/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=factorycomment/create');
	}

	public function testUpdate()
	{
		$this->open('?r=factorycomment/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=factorycomment/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=factorycomment/index');
	}

	public function testAdmin()
	{
		$this->open('?r=factorycomment/admin');
	}
}
