<?php

include_once('GIVEToHTML.php');

class GIVEAddr
{
	//public $id;							//INT
	public $street, $city, $state_us, $zip;	//STRING
	
	public function __construct($args)
	{
		//$this->id = $args['id'];
		$this->street = $args['street'];
		$this->city = $args['city'];
		$this->state_us = $args['state_us'];
		$this->zip = $args['zip'];
	}
	public function toHTMLTable($id)
	{
		$str = "<table id=\"$id\">".PHP_EOL;
		
		$str .= GIVEWrapDataWithTrTd($this->street, 'street');
		$str .= GIVEWrapDataWithTrTd($this->city, 'city');
		$str .= GIVEWrapDataWithTrTd($this->state_us, 'state_us');
		$str .= GIVEWrapDataWithTrTd($this->zip, 'zip');
	
		$str .= '</table>';
		return $str;
	}
}

?>
