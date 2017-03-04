<?php

class officesellinfoTest extends WebTestCase
{
	public $fixtures=array(
		'officesellinfos'=>'officesellinfo',
	);

	public function testShow()
	{
		$this->open('?r=officesellinfo/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=officesellinfo/create');
	}

	public function testUpdate()
	{
		$this->open('?r=officesellinfo/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=officesellinfo/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=officesellinfo/index');
	}

	public function testAdmin()
	{
		$this->open('?r=officesellinfo/admin');
	}
}
