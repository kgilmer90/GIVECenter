<?php

include_once(dirname(__FILE__).'/GIVEToHTML.php');

//Server-side definition an issues object, constitutes an array of issue ids
class GIVEIssues
{
	public $issues;
	
	//Constructor
	//If the array parameter is not properly set, initializes to an empty array
	public function __construct($args = array())
	{
		$issues = (isset($args)) ? $args : array();
	}
	
	//Used to print the object to an HTML table
	//@param $id - the id property of the table
	public function toHTMLTable($id)
	{
		$str = "<table id=\"$id\">".PHP_EOL;
		
		$i = 0;
		foreach($this->issues as $issue)
		{
			$str .= GIVEWrapDataWithTrTd($issue['id'], 'id');
			$str .= GIVEWrapDataWithTrTd($issue['name'], 'name');
			$i++;
		}
		$str .= '</table>';
		return $str;
	}
}
?>