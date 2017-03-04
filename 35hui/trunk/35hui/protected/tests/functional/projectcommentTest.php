<?php

class projectcommentTest extends WebTestCase
{
	public $fixtures=array(
		'projectcomments'=>'projectcomment',
	);

	public function testShow()
	{
		$this->open('?r=projectcomment/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=projectcomment/create');
	}

	public function testUpdate()
	{
		$this->open('?r=projectcomment/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=projectcomment/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=projectcomment/index');
	}

	public function testAdmin()
	{
		$this->open('?r=projectcomment/admin');
	}
}
