<?php

class officepresentinfoTest extends WebTestCase
{
	public $fixtures=array(
		'officepresentinfos'=>'officepresentinfo',
	);

	public function testShow()
	{
		$this->open('?r=officepresentinfo/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=officepresentinfo/create');
	}

	public function testUpdate()
	{
		$this->open('?r=officepresentinfo/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=officepresentinfo/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=officepresentinfo/index');
	}

	public function testAdmin()
	{
		$this->open('?r=officepresentinfo/admin');
	}
}
