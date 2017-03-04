<?php

class officebaseinfoTest extends WebTestCase
{
	public $fixtures=array(
		'officebaseinfos'=>'officebaseinfo',
	);

	public function testShow()
	{
		$this->open('?r=officebaseinfo/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=officebaseinfo/create');
	}

	public function testUpdate()
	{
		$this->open('?r=officebaseinfo/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=officebaseinfo/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=officebaseinfo/index');
	}

	public function testAdmin()
	{
		$this->open('?r=officebaseinfo/admin');
	}
}
