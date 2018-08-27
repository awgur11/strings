<?php

/**
* 
*/
class Request
{ 
	protected $data;
	
	function __construct($data)
	{
		$this->data = $data;
	}
	public function all()
	{
		return $this->data;
	}
	public function has($input)
	{
		if(isset($this->data[$input])) return 1;

		else return 0;
	}
	public function input($input)
	{
		return $this->data[$input];
	}
}