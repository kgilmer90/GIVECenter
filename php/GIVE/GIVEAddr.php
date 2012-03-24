<?php

class GIVEAddr
{
	public $id;								//INT
	public $street, $city, $state_us, $zip;	//STRING
	
	public function __construct($args)
	{
		$this->id = $args['id'];
		$this->street = $args['street'];
		$this->city = $args['city'];
		$this->state_us = $args['state_us'];
		$this->zip = $args['zip'];
	}
	
	public function __toString()
	{
		return "{$this->id}, {$this->street}, {$this->city}, {$this->state_us}, {$this->zip}";
	}
	
	public function toHTMLString()
	{
		return "{$this->id}, \"{$this->street}\", \"{$this->city}\", 
		\"{$this->state_us}\", {$this->zip}";
	}
}

?>
