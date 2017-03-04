<?php

class officetagTest extends WebTestCase
{
	public $fixtures=array(
		'officetags'=>'officetag',
	);

	public function testShow()
	{
		$this->open('?r=officetag/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=officetag/create');
	}

	public function testUpdate()
	{
		$this->open('?r=officetag/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=officetag/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=officetag/index');
	}

	public function testAdmin()
	{
		$this->open('?r=officetag/admin');
	}
}
