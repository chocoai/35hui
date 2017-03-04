<?php

class officerentinfoTest extends WebTestCase
{
	public $fixtures=array(
		'officerentinfos'=>'officerentinfo',
	);

	public function testShow()
	{
		$this->open('?r=officerentinfo/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=officerentinfo/create');
	}

	public function testUpdate()
	{
		$this->open('?r=officerentinfo/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=officerentinfo/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=officerentinfo/index');
	}

	public function testAdmin()
	{
		$this->open('?r=officerentinfo/admin');
	}
}
