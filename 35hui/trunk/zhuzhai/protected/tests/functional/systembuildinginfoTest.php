<?php

class systembuildinginfoTest extends WebTestCase
{
	public $fixtures=array(
		'systembuildinginfos'=>'systembuildinginfo',
	);

	public function testShow()
	{
		$this->open('?r=systembuildinginfo/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=systembuildinginfo/create');
	}

	public function testUpdate()
	{
		$this->open('?r=systembuildinginfo/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=systembuildinginfo/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=systembuildinginfo/index');
	}

	public function testAdmin()
	{
		$this->open('?r=systembuildinginfo/admin');
	}
}
