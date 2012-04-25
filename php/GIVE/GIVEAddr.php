<?php

include_once(dirname(__FILE__).'/GIVEToHTML.php');

class GIVEAddr
{
	public $id;
	public $street, $city, $state_us, $zip;	//STRING
	
	public function __construct($args = array())
	{
		$this->id = isset($args['id']) ? $args['id'] : '';
		$this->street = isset($args['street']) ? $args['street'] : '';
		$this->city = isset($args['city']) ? $args['city'] : '';
		$this->state_us = isset($args['state_us']) ? $args['state_us'] : '';
		$this->zip = isset($args['zip']) ? $args['zip'] : '';
	}
	public function toHTMLTable($id)
	{
		$str = "<table id=\"$id\">".PHP_EOL;
		
		$str .= GIVEWrapDataWithTrTd($this->id, 'id');
		$str .= GIVEWrapDataWithTrTd($this->street, 'street');
		$str .= GIVEWrapDataWithTrTd($this->city, 'city');
		$str .= GIVEWrapDataWithTrTd($this->state_us, 'state_us');
		$str .= GIVEWrapDataWithTrTd($this->zip, 'zip');
	
		$str .= '</table>';
		return $str;
	}
}

?>
