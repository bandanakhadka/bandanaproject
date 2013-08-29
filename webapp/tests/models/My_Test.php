<?php 

class My_Test extends CIUnit_TestCase
{
	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name,$data,$dataName);
	}

	public function test_my_test()
	{
		$this->assertStringEndsWith('o','hero');
	}
}