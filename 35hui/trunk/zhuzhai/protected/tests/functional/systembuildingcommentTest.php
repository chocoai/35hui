<?php

class systembuildingcommentTest extends WebTestCase
{
	public $fixtures=array(
		'systembuildingcomments'=>'systembuildingcomment',
	);

	public function testShow()
	{
		$this->open('?r=systembuildingcomment/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=systembuildingcomment/create');
	}

	public function testUpdate()
	{
		$this->open('?r=systembuildingcomment/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=systembuildingcomment/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=systembuildingcomment/index');
	}

	public function testAdmin()
	{
		$this->open('?r=systembuildingcomment/admin');
	}
}
