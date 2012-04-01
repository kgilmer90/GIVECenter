<?php

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
	
	public function __toString()
	{
		return /*"{$this->id},*/"{$this->street},{$this->city}, {$this->state_us}, {$this->zip}";
	}
	public function toHTMLString()
	{
		return /*__CLASS__.", {$this->id},*/ "\"{$this->street}\", \"{$this->city}\", ".
		"\"{$this->state_us}\", {$this->zip}";
	}
	public function toHTMLTable($id, $hidden = true, $display = 'none')
	{
		$visibility = ($hidden) ? 'hidden' : 'visible';
		$display = ($hidden) ? 'none' : 'block';
		
		$str = "<table id=\"$id\" style=\"visibility=$visibility;display=$display;\">".PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="street">'.PHP_EOL;
		$str .= $this->street.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="city">'.PHP_EOL;
		$str .= $this->city.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="state_us">'.PHP_EOL;
		$str .= $this->state_us.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
	
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="zip">'.PHP_EOL;
		$str .= $this->zip.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '</table>';
		return $str;
	}
}

?>
