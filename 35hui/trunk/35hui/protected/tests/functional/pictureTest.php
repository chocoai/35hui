<?php

class pictureTest extends WebTestCase
{
	public $fixtures=array(
		'pictures'=>'picture',
	);

	public function testShow()
	{
		$this->open('?r=picture/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=picture/create');
	}

	public function testUpdate()
	{
		$this->open('?r=picture/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=picture/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=picture/index');
	}

	public function testAdmin()
	{
		$this->open('?r=picture/admin');
	}
}
