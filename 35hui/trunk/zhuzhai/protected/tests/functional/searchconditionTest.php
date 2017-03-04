<?php

class searchconditionTest extends WebTestCase
{
	public $fixtures=array(
		'searchconditions'=>'searchcondition',
	);

	public function testShow()
	{
		$this->open('?r=searchcondition/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=searchcondition/create');
	}

	public function testUpdate()
	{
		$this->open('?r=searchcondition/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=searchcondition/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=searchcondition/index');
	}

	public function testAdmin()
	{
		$this->open('?r=searchcondition/admin');
	}
}
