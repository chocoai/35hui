<?php

class businesscommentTest extends WebTestCase
{
	public $fixtures=array(
		'businesscomments'=>'businesscomment',
	);

	public function testShow()
	{
		$this->open('?r=businesscomment/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=businesscomment/create');
	}

	public function testUpdate()
	{
		$this->open('?r=businesscomment/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=businesscomment/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=businesscomment/index');
	}

	public function testAdmin()
	{
		$this->open('?r=businesscomment/admin');
	}
}
