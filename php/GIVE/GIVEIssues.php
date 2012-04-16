<?php

include_once(dirname(__FILE__).'/GIVEToHTML.php');

class GIVEIssues
{
	public $issues;
	
	public function __construct($args = array())
	{
		$issues = (isset($args)) ? $args : array();
	}
	
	public function toHTMLTable($id)
	{
		$str = "<table id=\"$id\">".PHP_EOL;
		
		$i = 0;
		foreach($this->issues as $issue)
		{
			$str .= GIVEWrapDataWithTrTd();
			$i++;
		}
		$str .= '</table>';
		return $str;
	}
}
?>