<?php

class officefacilityinfoTest extends WebTestCase
{
	public $fixtures=array(
		'officefacilityinfos'=>'officefacilityinfo',
	);

	public function testShow()
	{
		$this->open('?r=officefacilityinfo/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=officefacilityinfo/create');
	}

	public function testUpdate()
	{
		$this->open('?r=officefacilityinfo/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=officefacilityinfo/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=officefacilityinfo/index');
	}

	public function testAdmin()
	{
		$this->open('?r=officefacilityinfo/admin');
	}
}
