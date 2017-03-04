<?php

class officecommentTest extends WebTestCase
{
	public $fixtures=array(
		'officecomments'=>'officecomment',
	);

	public function testShow()
	{
		$this->open('?r=officecomment/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=officecomment/create');
	}

	public function testUpdate()
	{
		$this->open('?r=officecomment/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=officecomment/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=officecomment/index');
	}

	public function testAdmin()
	{
		$this->open('?r=officecomment/admin');
	}
}
