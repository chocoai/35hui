<?php

class shopcommentTest extends WebTestCase
{
	public $fixtures=array(
		'shopcomments'=>'shopcomment',
	);

	public function testShow()
	{
		$this->open('?r=shopcomment/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=shopcomment/create');
	}

	public function testUpdate()
	{
		$this->open('?r=shopcomment/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=shopcomment/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=shopcomment/index');
	}

	public function testAdmin()
	{
		$this->open('?r=shopcomment/admin');
	}
}
